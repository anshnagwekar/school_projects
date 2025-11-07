# NFL Stat Leaders App

A Python application that fetches and displays NFL statistical leaders for the current season. View the top performers in passing, rushing, and receiving categories.

## Features

- Display statistical leaders across multiple categories:
  - Passing yards
  - Rushing yards
  - Receiving yards
- Customizable number of leaders to display
- Filter by specific statistical category
- Clean, formatted console output
- Automatic fallback to sample data when API is unavailable

## Requirements

- Python 3.6+
- requests library

## Installation

1. Clone or download this repository

2. Install dependencies:
```bash
pip install -r requirements.txt
```

## Usage

### Show all stat categories (top 10 each)
```bash
python3 nfl_stats.py
```

### Show top 5 leaders in each category
```bash
python3 nfl_stats.py -l 5
```

### Show only passing leaders
```bash
python3 nfl_stats.py -c passing
```

### Show top 15 rushing leaders
```bash
python3 nfl_stats.py -c rushing -l 15
```

### Show receiving leaders (top 10)
```bash
python3 nfl_stats.py -c receiving
```

## Command Line Options

- `-l, --limit`: Number of leaders to display per category (default: 10)
- `-c, --category`: Specific category to display (choices: passing, rushing, receiving)
- `-h, --help`: Show help message

## Example Output

```
🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈
NFL STATISTICAL LEADERS - 2024 Season
🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈🏈


================================================================================
PASSING YARDS LEADERS
================================================================================
Rank  Player                        Team    Yards
--------------------------------------------------------------------------------
1     Josh Allen                    BUF     3,964
2     Tua Tagovailoa                MIA     3,548
3     Jared Goff                    DET     3,494
4     Patrick Mahomes               KC      3,281
5     CJ Stroud                     HOU     3,117
```

## How It Works

The application attempts to fetch live NFL statistics from ESPN's API. If the API is unavailable or encounters an error, it falls back to displaying sample data from the 2024 NFL season for demonstration purposes.

## Data Source

- Primary: ESPN NFL Statistics API
- Fallback: Sample 2024 season data

## Project Structure

```
nfl-stat-leaders/
├── nfl_stats.py        # Main application file
├── requirements.txt    # Python dependencies
└── README.md          # This file
```

## Future Enhancements

Potential improvements for the application:

- Add more statistical categories (touchdowns, interceptions, sacks, etc.)
- Support for different seasons
- Export results to CSV or JSON
- Team statistics
- Player search functionality
- Graphical visualization of stats
- Real-time game updates

## License

This is a school project created for educational purposes.

## Author

Created as part of a school programming project.
