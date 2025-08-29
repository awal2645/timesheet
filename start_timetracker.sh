#!/bin/bash

# Get the directory where the script is located
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

# Change to the desktop-app directory
cd "$SCRIPT_DIR/desktop-app"

# Create virtual environment if it doesn't exist
if [ ! -d "venv" ]; then
    echo "Creating virtual environment..."
    python3 -m venv venv
fi

# Activate virtual environment
source venv/bin/activate

# Install or upgrade dependencies
echo "Installing/upgrading dependencies..."
pip install -r requirements.txt

# Start the application
echo "Starting TimeTracker..."
python3 main.py 