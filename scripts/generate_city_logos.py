#!/usr/bin/env python3
"""
City Brand Logo Generator
Generates exact editorial brand masthead logos for all cities:
- logo-{slug}.png (Black on transparent, 336x128)
- logo-{slug}-white.png (White on transparent, 336x128)
- logo-{slug}-square.png (Black on 500x500 transparent)

Matches exact typography from user brand mark:
- Bodoni Moda 'I' and 'cons'
- Tracked Plus Jakarta Sans uppercase city name across top
"""

import os
import sys
from PIL import Image, ImageFont, ImageDraw
import numpy as np

def generate_logos():
    base_dir = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
    images_dir = os.path.join(base_dir, 'public', 'images')
    
    # Base templates
    black_tpl_path = os.path.join(images_dir, 'logo-cityicons.png')
    white_tpl_path = os.path.join(images_dir, 'logo-cityicons-white.png')
    
    if not os.path.exists(black_tpl_path) or not os.path.exists(white_tpl_path):
        print("Template files not found!")
        return
        
    img_black = Image.open(black_tpl_path)
    t_black = np.array(img_black)
    t_black[0:32, 50:, 3] = 0

    img_white = Image.open(white_tpl_path)
    t_white = np.array(img_white)
    t_white[0:32, 50:, 3] = 0

    # Font setup
    try:
        font = ImageFont.truetype('jakarta.ttf', 19)
    except:
        font = ImageFont.load_default()

    cities = [
        ('bhavnagar', 'BHAVNAGAR'),
        ('ahmedabad', 'AHMEDABAD'),
        ('mumbai', 'MUMBAI'),
        ('surat', 'SURAT'),
        ('rajkot', 'RAJKOT'),
        ('vadodara', 'VADODARA'),
        ('delhi', 'DELHI'),
        ('bengaluru', 'BENGALURU'),
        ('jaipur', 'JAIPUR'),
        ('kolkata', 'KOLKATA')
    ]

    for slug, name in cities:
        for mode, t_arr, color in [('black', t_black, (0, 0, 0, 255)), ('white', t_white, (255, 255, 255, 255))]:
            canvas = Image.fromarray(t_arr.copy())
            draw = ImageDraw.Draw(canvas)
            
            char_widths = [draw.textbbox((0, 0), ch, font=font)[2] - draw.textbbox((0, 0), ch, font=font)[0] for ch in name]
            total_char_width = sum(char_widths)
            avail_width = 258
            
            if len(name) > 1:
                spacing = (avail_width - total_char_width) / (len(name) - 1)
            else:
                spacing = 0
                
            x_curr = 65
            for ch in name:
                draw.text((x_curr, 9), ch, font=font, fill=color)
                w = draw.textbbox((0, 0), ch, font=font)[2] - draw.textbbox((0, 0), ch, font=font)[0]
                x_curr += w + spacing
                
            suffix = '-white' if mode == 'white' else ''
            out_path = os.path.join(images_dir, f'logo-{slug}{suffix}.png')
            canvas.save(out_path)
            
            if mode == 'black':
                square = Image.new('RGBA', (500, 500), (0, 0, 0, 0))
                crop = canvas.crop((6, 6, 330, 122))
                square.paste(crop, (88, 175), crop)
                square.save(os.path.join(images_dir, f'logo-{slug}-square.png'))

    print("All city logos generated successfully!")

if __name__ == '__main__':
    generate_logos()
