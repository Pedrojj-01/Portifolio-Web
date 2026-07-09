import { writeFile, mkdir } from 'node:fs/promises';
import { dirname } from 'node:path';
import { fileURLToPath } from 'node:url';
import { deflateSync } from 'node:zlib';

const outDir = new URL('../assets/', import.meta.url);

function crc32(buffer) {
    let crc = -1;
    for (const byte of buffer) {
        crc = (crc >>> 8) ^ table[(crc ^ byte) & 0xff];
    }
    return (crc ^ -1) >>> 0;
}

const table = new Uint32Array(256);
for (let i = 0; i < 256; i += 1) {
    let c = i;
    for (let k = 0; k < 8; k += 1) {
        c = c & 1 ? 0xedb88320 ^ (c >>> 1) : c >>> 1;
    }
    table[i] = c >>> 0;
}

function chunk(type, data = Buffer.alloc(0)) {
    const name = Buffer.from(type);
    const length = Buffer.alloc(4);
    length.writeUInt32BE(data.length);
    const checksum = Buffer.alloc(4);
    checksum.writeUInt32BE(crc32(Buffer.concat([name, data])));
    return Buffer.concat([length, name, data, checksum]);
}

function createCanvas(width, height) {
    const pixels = Buffer.alloc(width * height * 4);
    const toByte = (value) => Math.max(0, Math.min(255, Math.round(value)));

    const blend = (x, y, color, alpha = color[3] ?? 255) => {
        if (x < 0 || y < 0 || x >= width || y >= height || alpha <= 0) {
            return;
        }
        const index = (Math.floor(y) * width + Math.floor(x)) * 4;
        const a = alpha / 255;
        pixels[index] = toByte(color[0] * a + pixels[index] * (1 - a));
        pixels[index + 1] = toByte(color[1] * a + pixels[index + 1] * (1 - a));
        pixels[index + 2] = toByte(color[2] * a + pixels[index + 2] * (1 - a));
        pixels[index + 3] = 255;
    };

    const fillGradient = (stops) => {
        for (let y = 0; y < height; y += 1) {
            for (let x = 0; x < width; x += 1) {
                const t = (x / width) * 0.62 + (y / height) * 0.38;
                let left = stops[0];
                let right = stops[stops.length - 1];

                for (let i = 0; i < stops.length - 1; i += 1) {
                    if (t >= stops[i].at && t <= stops[i + 1].at) {
                        left = stops[i];
                        right = stops[i + 1];
                        break;
                    }
                }

                const local = (t - left.at) / (right.at - left.at || 1);
                const wave = Math.sin((x + y) * 0.018) * 5;
                blend(x, y, [
                    lerp(left.color[0], right.color[0], local) + wave,
                    lerp(left.color[1], right.color[1], local) + wave,
                    lerp(left.color[2], right.color[2], local) + wave,
                    255,
                ]);
            }
        }
    };

    const rect = (x, y, w, h, color, alpha) => {
        for (let yy = Math.floor(y); yy < y + h; yy += 1) {
            for (let xx = Math.floor(x); xx < x + w; xx += 1) {
                blend(xx, yy, color, alpha);
            }
        }
    };

    const roundedRect = (x, y, w, h, r, color, alpha = color[3] ?? 255) => {
        const x2 = x + w;
        const y2 = y + h;
        for (let yy = Math.floor(y); yy < y2; yy += 1) {
            for (let xx = Math.floor(x); xx < x2; xx += 1) {
                const dx = Math.max(x + r - xx, 0, xx - (x2 - r));
                const dy = Math.max(y + r - yy, 0, yy - (y2 - r));
                if (dx * dx + dy * dy <= r * r) {
                    blend(xx, yy, color, alpha);
                }
            }
        }
    };

    const circle = (cx, cy, radius, color, alpha = color[3] ?? 255) => {
        const r2 = radius * radius;
        for (let y = Math.floor(cy - radius); y <= cy + radius; y += 1) {
            for (let x = Math.floor(cx - radius); x <= cx + radius; x += 1) {
                const dx = x - cx;
                const dy = y - cy;
                if (dx * dx + dy * dy <= r2) {
                    blend(x, y, color, alpha);
                }
            }
        }
    };

    const polygon = (points, color, alpha = color[3] ?? 255) => {
        const minX = Math.floor(Math.min(...points.map(([x]) => x)));
        const maxX = Math.ceil(Math.max(...points.map(([x]) => x)));
        const minY = Math.floor(Math.min(...points.map(([, y]) => y)));
        const maxY = Math.ceil(Math.max(...points.map(([, y]) => y)));

        for (let y = minY; y <= maxY; y += 1) {
            for (let x = minX; x <= maxX; x += 1) {
                let inside = false;
                for (let i = 0, j = points.length - 1; i < points.length; j = i, i += 1) {
                    const [xi, yi] = points[i];
                    const [xj, yj] = points[j];
                    const intersects = yi > y !== yj > y && x < ((xj - xi) * (y - yi)) / (yj - yi) + xi;
                    if (intersects) {
                        inside = !inside;
                    }
                }
                if (inside) {
                    blend(x, y, color, alpha);
                }
            }
        }
    };

    const line = (x1, y1, x2, y2, color, widthLine = 2, alpha = color[3] ?? 255) => {
        const steps = Math.max(Math.abs(x2 - x1), Math.abs(y2 - y1));
        for (let i = 0; i <= steps; i += 1) {
            const t = i / steps;
            const x = lerp(x1, x2, t);
            const y = lerp(y1, y2, t);
            circle(x, y, widthLine / 2, color, alpha);
        }
    };

    const save = async (fileName) => {
        const rows = [];
        for (let y = 0; y < height; y += 1) {
            rows.push(Buffer.from([0]));
            rows.push(pixels.subarray(y * width * 4, (y + 1) * width * 4));
        }

        const header = Buffer.alloc(13);
        header.writeUInt32BE(width, 0);
        header.writeUInt32BE(height, 4);
        header[8] = 8;
        header[9] = 6;

        const png = Buffer.concat([
            Buffer.from([0x89, 0x50, 0x4e, 0x47, 0x0d, 0x0a, 0x1a, 0x0a]),
            chunk('IHDR', header),
            chunk('IDAT', deflateSync(Buffer.concat(rows), { level: 9 })),
            chunk('IEND'),
        ]);

        const url = new URL(fileName, outDir);
        await mkdir(dirname(fileURLToPath(url)), { recursive: true });
        await writeFile(url, png);
    };

    return { fillGradient, rect, roundedRect, circle, polygon, line, save, width, height };
}

function lerp(a, b, t) {
    return a + (b - a) * Math.max(0, Math.min(1, t));
}

function drawInterface(canvas, x, y, scale, palette) {
    const s = scale;
    canvas.roundedRect(x + 18 * s, y + 30 * s, 540 * s, 350 * s, 18 * s, [0, 0, 0], 62);
    canvas.roundedRect(x, y, 540 * s, 350 * s, 22 * s, palette.panel, 238);
    canvas.rect(x, y, 540 * s, 54 * s, palette.header, 245);
    canvas.circle(x + 32 * s, y + 28 * s, 7 * s, [255, 103, 71], 255);
    canvas.circle(x + 56 * s, y + 28 * s, 7 * s, [233, 185, 73], 255);
    canvas.circle(x + 80 * s, y + 28 * s, 7 * s, [56, 217, 150], 255);

    for (let i = 0; i < 7; i += 1) {
        canvas.roundedRect(x + 34 * s, y + (86 + i * 32) * s, (90 + (i % 3) * 38) * s, 10 * s, 5 * s, palette.line, 210);
    }

    canvas.roundedRect(x + 245 * s, y + 86 * s, 230 * s, 100 * s, 14 * s, palette.accent, 220);
    canvas.roundedRect(x + 245 * s, y + 214 * s, 90 * s, 82 * s, 12 * s, [255, 255, 255], 220);
    canvas.roundedRect(x + 358 * s, y + 214 * s, 118 * s, 82 * s, 12 * s, [255, 255, 255], 180);
    canvas.line(x + 270 * s, y + 260 * s, x + 310 * s, y + 235 * s, palette.header, 5 * s, 180);
    canvas.line(x + 383 * s, y + 260 * s, x + 446 * s, y + 238 * s, palette.header, 5 * s, 180);
}

async function hero() {
    const canvas = createCanvas(1600, 1040);
    canvas.fillGradient([
        { at: 0, color: [14, 17, 16] },
        { at: 0.32, color: [27, 45, 53] },
        { at: 0.62, color: [88, 54, 96] },
        { at: 1, color: [255, 112, 75] },
    ]);

    for (let x = 0; x < canvas.width; x += 88) {
        canvas.line(x, 0, x - 280, canvas.height, [255, 255, 255], 1, 20);
    }

    canvas.polygon([[1030, 0], [1600, 0], [1510, 350], [890, 460]], [56, 217, 150], 72);
    canvas.polygon([[880, 640], [1420, 500], [1600, 1040], [760, 1040]], [255, 103, 71], 70);
    canvas.polygon([[1210, 520], [1600, 560], [1600, 1040], [1380, 1040]], [76, 92, 255], 82);
    canvas.polygon([[650, 880], [1400, 760], [1560, 820], [720, 970]], [255, 255, 255], 34);

    drawInterface(canvas, 730, 240, 1.25, {
        panel: [246, 247, 241],
        header: [24, 24, 24],
        line: [68, 75, 85],
        accent: [56, 217, 150],
    });

    drawInterface(canvas, 1030, 560, 0.78, {
        panel: [255, 255, 255],
        header: [20, 21, 22],
        line: [76, 92, 255],
        accent: [255, 103, 71],
    });

    canvas.roundedRect(1110, 155, 220, 360, 34, [12, 13, 14], 238);
    canvas.roundedRect(1130, 184, 180, 300, 24, [246, 247, 241], 250);
    canvas.roundedRect(1152, 226, 136, 24, 12, [76, 92, 255], 220);
    canvas.roundedRect(1152, 272, 86, 86, 18, [56, 217, 150], 230);
    canvas.roundedRect(1250, 272, 38, 86, 18, [255, 103, 71], 230);
    canvas.line(1160, 406, 1284, 382, [22, 22, 22], 8, 140);

    canvas.roundedRect(720, 820, 650, 18, 9, [255, 255, 255], 80);
    await canvas.save('hero-visual.png');
}

async function project(fileName, colors) {
    const canvas = createCanvas(900, 620);
    canvas.fillGradient([
        { at: 0, color: colors.bg1 },
        { at: 0.55, color: colors.bg2 },
        { at: 1, color: colors.bg3 },
    ]);

    canvas.polygon([[590, 0], [900, 0], [840, 210], [520, 160]], colors.glow, 82);
    canvas.polygon([[0, 430], [250, 360], [370, 620], [0, 620]], [255, 255, 255], 40);
    canvas.roundedRect(86, 78, 728, 456, 26, [255, 255, 255], 224);
    canvas.rect(86, 78, 728, 72, colors.dark, 245);
    canvas.circle(132, 114, 9, [255, 103, 71], 255);
    canvas.circle(164, 114, 9, [233, 185, 73], 255);
    canvas.circle(196, 114, 9, [56, 217, 150], 255);

    canvas.roundedRect(130, 190, 170, 250, 16, colors.accent, 222);
    canvas.roundedRect(330, 190, 214, 98, 16, [22, 22, 22], 205);
    canvas.roundedRect(330, 318, 214, 122, 16, [255, 255, 255], 220);
    canvas.roundedRect(574, 190, 196, 250, 16, [246, 247, 241], 230);

    for (let i = 0; i < 5; i += 1) {
        canvas.roundedRect(606, 226 + i * 36, 118 + (i % 2) * 26, 10, 5, colors.dark, 120);
    }

    canvas.line(365, 382, 520, 350, colors.accent, 9, 210);
    canvas.line(370, 255, 502, 235, [255, 255, 255], 7, 170);
    await canvas.save(fileName);
}

await hero();
await project('project-dashboard.png', {
    bg1: [27, 31, 30],
    bg2: [40, 88, 82],
    bg3: [56, 217, 150],
    dark: [19, 20, 20],
    accent: [56, 217, 150],
    glow: [76, 92, 255],
});
await project('project-commerce.png', {
    bg1: [28, 18, 32],
    bg2: [168, 67, 81],
    bg3: [255, 159, 87],
    dark: [25, 18, 23],
    accent: [255, 103, 71],
    glow: [233, 185, 73],
});
await project('project-brand.png', {
    bg1: [22, 24, 34],
    bg2: [72, 86, 198],
    bg3: [214, 231, 255],
    dark: [19, 20, 30],
    accent: [76, 92, 255],
    glow: [56, 217, 150],
});
