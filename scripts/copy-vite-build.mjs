import { cp, mkdir, rm, writeFile } from 'node:fs/promises';
import { existsSync } from 'node:fs';

const source = 'public/build';
const target = 'dist';

if (!existsSync(source)) {
    throw new Error(`Expected ${source} to exist after vite build.`);
}

await rm(target, { recursive: true, force: true });
await mkdir(target, { recursive: true });
await cp(source, target, { recursive: true });
await writeFile(
    `${target}/index.html`,
    '<!doctype html><html><head><meta charset="utf-8"><title>Laravel Assets</title></head><body></body></html>\n'
);
