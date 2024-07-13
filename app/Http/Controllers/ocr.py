import cv2
import pytesseract
import numpy as np
import argparse

# Argument parser to take the image path from the command line
ap = argparse.ArgumentParser()
ap.add_argument("-i", "--image", required=True, help="path to input image to be OCR'd")
args = vars(ap.parse_args())

# Read the image in grayscale
image = cv2.imread(args["image"], cv2.IMREAD_GRAYSCALE)

# Resize the image to upscale small text
image = cv2.resize(image, None, fx=2, fy=2, interpolation=cv2.INTER_CUBIC)

# Increase contrast and brightness
alpha = 1.5  # Contrast control (1.0-3.0)
beta = 50    # Brightness control (0-100)
adjusted = cv2.convertScaleAbs(image, alpha=alpha, beta=beta)

# Apply GaussianBlur to reduce noise
blurred = cv2.GaussianBlur(adjusted, (5, 5), 0)

# Apply adaptive thresholding to create a binary image
_, thresh = cv2.threshold(blurred, 0, 255, cv2.THRESH_BINARY + cv2.THRESH_OTSU)

# Use morphological operations to remove small noise
kernel = np.ones((3, 3), np.uint8)
opening = cv2.morphologyEx(thresh, cv2.MORPH_OPEN, kernel, iterations=1)

# Find contours of text regions
contours, _ = cv2.findContours(opening, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)

# Draw contours on the original image
result = image.copy()
cv2.drawContours(result, contours, -1, (0, 255, 0), 2)

# Perform additional preprocessing to enhance OCR accuracy
# Sharpen the image
sharp_kernel = np.array([[0, -1, 0], [-1, 5, -1], [0, -1, 0]])
sharpened = cv2.filter2D(result, -1, sharp_kernel)

# Apply median blur
median = cv2.medianBlur(sharpened, 3)

# Apply adaptive thresholding again
final_thresh = cv2.threshold(median, 0, 255, cv2.THRESH_BINARY + cv2.THRESH_OTSU)[1]

# Tesseract configuration to improve OCR accuracy
custom_config = r'--oem 3 --psm 6'

# Convert the processed image to text using Tesseract
text = pytesseract.image_to_string(final_thresh, config=custom_config)

# Ensure text is properly encoded
text = text.encode('utf-8').decode('utf-8')

# Print the extracted text
print(text)