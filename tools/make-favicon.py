from pathlib import Path

from PIL import Image

root = Path(__file__).resolve().parents[1]
src = root / "portfolio-frontend" / "images" / "DIGITAL MATRIX TECHNOLOGY.png"
out_png = root / "portfolio-frontend" / "images" / "favicon.png"
out_apple = root / "portfolio-frontend" / "images" / "apple-touch-icon.png"
out_ico = root / "portfolio-frontend" / "images" / "favicon.ico"

im = Image.open(src).convert("RGBA")
pixels = im.load()
width, height = im.size

left, top, right, bottom = width, height, 0, 0
for y in range(height):
    for x in range(width):
        r, g, b, a = pixels[x, y]
        if r > 180 and g > 140 and b < 90:
            if x < left:
                left = x
            if y < top:
                top = y
            if x > right:
                right = x
            if y > bottom:
                bottom = y

pad = 22
# Keep the navy divider out of the crop
line_x = right + 1
while line_x < width:
    r, g, b, a = pixels[line_x, (top + bottom) // 2]
    if b > r + 20 and r < 90:
        break
    line_x += 1

left = max(0, left - pad)
top = max(0, top - pad)
right = min(line_x - 8, right + 10)
bottom = min(height - 1, bottom + pad)

crop = im.crop((left, top, right + 1, bottom + 1)).convert("RGBA")
cw, ch = crop.size
side = max(cw, ch)
square = Image.new("RGBA", (side, side), (255, 255, 255, 255))
square.paste(crop, ((side - cw) // 2, (side - ch) // 2))

favicon = square.resize((512, 512), Image.Resampling.LANCZOS)
favicon.save(out_png, "PNG")
favicon.resize((180, 180), Image.Resampling.LANCZOS).save(out_apple, "PNG")
favicon.save(
    out_ico,
    format="ICO",
    sizes=[(16, 16), (32, 32), (48, 48), (64, 64), (128, 128), (256, 256)],
)

print("cropped", left, top, right, bottom)
print("wrote", out_png.name, out_apple.name, out_ico.name)
