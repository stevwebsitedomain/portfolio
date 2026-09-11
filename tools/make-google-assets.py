from pathlib import Path

from PIL import Image, ImageDraw, ImageFont, ImageOps

root = Path(__file__).resolve().parents[1]
public = root / "public"
images = public / "images"

mark = Image.open(images / "favicon.png").convert("RGBA")
profile = Image.open(images / "profile.png").convert("RGB")

for size in (48, 96, 192, 512):
    out = mark.resize((size, size), Image.Resampling.LANCZOS)
    if size == 512:
        out.save(images / "favicon.png", "PNG")
    else:
        out.save(public / f"favicon-{size}x{size}.png", "PNG")

apple = mark.resize((180, 180), Image.Resampling.LANCZOS)
apple.save(public / "apple-touch-icon.png", "PNG")
apple.save(images / "apple-touch-icon.png", "PNG")

side = min(profile.size)
left = (profile.width - side) // 2
top = max(0, (profile.height - side) // 6)
portrait = profile.crop((left, top, left + side, top + side)).resize(
    (800, 800), Image.Resampling.LANCZOS
)
portrait.save(images / "steven-makarious.jpg", "JPEG", quality=90)

navy = (18, 58, 99)
card = Image.new("RGB", (1200, 630), navy)
photo = ImageOps.fit(profile, (520, 630), Image.Resampling.LANCZOS, centering=(0.5, 0.18))
card.paste(photo, (0, 0))
draw = ImageDraw.Draw(card)
badge = mark.resize((72, 72), Image.Resampling.LANCZOS)
card.paste(badge, (580, 118), badge)

font_dir = Path(r"C:\Windows\Fonts")
title_font = ImageFont.truetype(str(font_dir / "arialbd.ttf"), 46)
sub_font = ImageFont.truetype(str(font_dir / "arial.ttf"), 26)
brand_font = ImageFont.truetype(str(font_dir / "arial.ttf"), 22)

draw.text((580, 210), "Steven Makarious", font=title_font, fill=(255, 255, 255))
draw.text((580, 272), "Full Stack Developer", font=sub_font, fill=(255, 214, 90))
draw.text((580, 322), "Digital Matrix Technology", font=brand_font, fill=(210, 226, 240))
draw.text((580, 368), "Tanzania  ·  Websites, systems & cloud", font=brand_font, fill=(168, 196, 216))

card.save(images / "og-share.jpg", "JPEG", quality=90)
print("wrote favicon sizes, portrait, og-share.jpg")
