import cv2
import pytesseract
import numpy as np
import argparse

ap = argparse.ArgumentParser()
ap.add_argument("-i", "--image", required=True,
	help="path to input image to be OCR'd")
args = vars(ap.parse_args())

# Read the image
image = cv2.imread(args["image"], cv2.IMREAD_GRAYSCALE)

# Apply GaussianBlur to reduce noise
blurred = cv2.GaussianBlur(image, (5, 5), 0)

# Apply adaptive thresholding to create a binary image
_, thresh = cv2.threshold(blurred, 0, 255, cv2.THRESH_BINARY + cv2.THRESH_OTSU)

# Use morphological operations to remove small noise
kernel = np.ones((3, 3), np.uint8)
opening = cv2.morphologyEx(thresh, cv2.MORPH_OPEN, kernel, iterations=2)

# Find contours of text regions
contours, _ = cv2.findContours(opening, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)

# Draw contours on the original image
result = image.copy()
cv2.drawContours(result, contours, -1, (0, 255, 0), 2)

# Perform additional preprocessing to enhance OCR accuracy
result = cv2.medianBlur(result, 3)  # Apply median blur
result = cv2.threshold(result, 0, 255, cv2.THRESH_BINARY + cv2.THRESH_OTSU)[1]  # Apply adaptive thresholding

# Convert the result to text using Tesseract
text = pytesseract.image_to_string(result)

# Print the extracted text
print(text)