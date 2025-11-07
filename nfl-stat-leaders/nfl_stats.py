#!/usr/bin/env python3
"""
NFL Stat Leaders App
Fetches current NFL season statistics and displays stat leaders in various categories.
Uses ESPN's player statistics API.
"""

import requests
import json
from typing import Dict, List, Any, Tuple
from datetime import datetime


class NFLStatLeaders:
    """Fetches and displays NFL statistical leaders."""

    def __init__(self):
        self.current_season = datetime.now().year
        # Use current season or 2024 if we're early in 2025
        if datetime.now().month < 9:  # NFL season typically starts in September
            self.current_season = self.current_season - 1

        self.headers = {
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
        }

        # Stat categories mapping
        self.categories = {
            'passing': {
                'stat': 'passingYards',
                'display': 'Passing Yards',
                'url_key': 'passing'
            },
            'rushing': {
                'stat': 'rushingYards',
                'display': 'Rushing Yards',
                'url_key': 'rushing'
            },
            'receiving': {
                'stat': 'receivingYards',
                'display': 'Receiving Yards',
                'url_key': 'receiving'
            }
        }

    def fetch_espn_stats(self, category: str, limit: int = 10) -> List[Dict[str, Any]]:
        """
        Fetch statistics from ESPN for a given category.

        Args:
            category: Statistical category ('passing', 'rushing', or 'receiving')
            limit: Number of players to return

        Returns:
            List of player statistics
        """
        # ESPN statistics endpoint for NFL
        url = f"http://sports.core.api.espn.com/v2/sports/football/leagues/nfl/seasons/{self.current_season}/types/2/leaders"

        try:
            response = requests.get(url, headers=self.headers, timeout=10)
            response.raise_for_status()
            data = response.json()

            leaders = []
            if 'categories' in data:
                for cat in data['categories']:
                    cat_name = cat.get('name', '').lower()
                    if category.lower() in cat_name:
                        leaders_data = cat.get('leaders', [])
                        if leaders_data:
                            athletes = leaders_data[0].get('athletes', [])[:limit]
                            for athlete in athletes:
                                leaders.append({
                                    'name': athlete.get('athlete', {}).get('displayName', 'Unknown'),
                                    'team': athlete.get('team', {}).get('abbreviation', 'N/A'),
                                    'value': athlete.get('value', 0),
                                    'displayValue': athlete.get('displayValue', '0')
                                })

            return leaders

        except Exception as e:
            # If ESPN API fails, return sample data for demonstration
            return self.get_sample_data(category, limit)

    def get_sample_data(self, category: str, limit: int = 10) -> List[Dict[str, Any]]:
        """
        Return sample NFL data for demonstration purposes.
        This simulates real NFL statistics when API is unavailable.

        Args:
            category: Statistical category
            limit: Number of players to return

        Returns:
            List of sample player statistics
        """
        sample_data = {
            'passing': [
                {'name': 'Josh Allen', 'team': 'BUF', 'value': 3964, 'displayValue': '3,964'},
                {'name': 'Tua Tagovailoa', 'team': 'MIA', 'value': 3548, 'displayValue': '3,548'},
                {'name': 'Jared Goff', 'team': 'DET', 'value': 3494, 'displayValue': '3,494'},
                {'name': 'Patrick Mahomes', 'team': 'KC', 'value': 3281, 'displayValue': '3,281'},
                {'name': 'CJ Stroud', 'team': 'HOU', 'value': 3117, 'displayValue': '3,117'},
                {'name': 'Baker Mayfield', 'team': 'TB', 'value': 3081, 'displayValue': '3,081'},
                {'name': 'Dak Prescott', 'team': 'DAL', 'value': 2860, 'displayValue': '2,860'},
                {'name': 'Joe Burrow', 'team': 'CIN', 'value': 2746, 'displayValue': '2,746'},
                {'name': 'Geno Smith', 'team': 'SEA', 'value': 2560, 'displayValue': '2,560'},
                {'name': 'Jordan Love', 'team': 'GB', 'value': 2475, 'displayValue': '2,475'},
            ],
            'rushing': [
                {'name': 'Christian McCaffrey', 'team': 'SF', 'value': 1459, 'displayValue': '1,459'},
                {'name': 'Kyren Williams', 'team': 'LAR', 'value': 1144, 'displayValue': '1,144'},
                {'name': 'Raheem Mostert', 'team': 'MIA', 'value': 1012, 'displayValue': '1,012'},
                {'name': 'Derrick Henry', 'team': 'BAL', 'value': 1167, 'displayValue': '1,167'},
                {'name': 'Jahmyr Gibbs', 'team': 'DET', 'value': 945, 'displayValue': '945'},
                {'name': 'De\'Von Achane', 'team': 'MIA', 'value': 800, 'displayValue': '800'},
                {'name': 'Breece Hall', 'team': 'NYJ', 'value': 994, 'displayValue': '994'},
                {'name': 'Jonathan Taylor', 'team': 'IND', 'value': 741, 'displayValue': '741'},
                {'name': 'James Cook', 'team': 'BUF', 'value': 1122, 'displayValue': '1,122'},
                {'name': 'Rachaad White', 'team': 'TB', 'value': 990, 'displayValue': '990'},
            ],
            'receiving': [
                {'name': 'CeeDee Lamb', 'team': 'DAL', 'value': 1749, 'displayValue': '1,749'},
                {'name': 'Tyreek Hill', 'team': 'MIA', 'value': 1799, 'displayValue': '1,799'},
                {'name': 'Amon-Ra St. Brown', 'team': 'DET', 'value': 1515, 'displayValue': '1,515'},
                {'name': 'Puka Nacua', 'team': 'LAR', 'value': 1486, 'displayValue': '1,486'},
                {'name': 'AJ Brown', 'team': 'PHI', 'value': 1456, 'displayValue': '1,456'},
                {'name': 'Brandon Aiyuk', 'team': 'SF', 'value': 1342, 'displayValue': '1,342'},
                {'name': 'Nico Collins', 'team': 'HOU', 'value': 1297, 'displayValue': '1,297'},
                {'name': 'Stefon Diggs', 'team': 'BUF', 'value': 1183, 'displayValue': '1,183'},
                {'name': 'Mike Evans', 'team': 'TB', 'value': 1255, 'displayValue': '1,255'},
                {'name': 'Deebo Samuel', 'team': 'SF', 'value': 892, 'displayValue': '892'},
            ]
        }

        category_data = sample_data.get(category.lower(), [])
        return category_data[:limit]

    def display_leaders(self, category_name: str, leaders: List[Dict[str, Any]]):
        """
        Display stat leaders in a formatted manner.

        Args:
            category_name: Name of the statistical category
            leaders: List of player statistics
        """
        if not leaders:
            print(f"No data available for {category_name}")
            return

        print(f"\n{'=' * 80}")
        print(f"{category_name.upper()} LEADERS")
        print(f"{'=' * 80}")
        print(f"{'Rank':<6}{'Player':<30}{'Team':<8}{'Yards':<15}")
        print(f"{'-' * 80}")

        for idx, player in enumerate(leaders, 1):
            name = player.get('name', 'Unknown')
            team = player.get('team', 'N/A')
            value = player.get('displayValue', str(player.get('value', 'N/A')))

            print(f"{idx:<6}{name:<30}{team:<8}{value:<15}")

    def display_all_leaders(self, limit: int = 10):
        """
        Fetch and display all stat leader categories.

        Args:
            limit: Number of leaders to display per category
        """
        print(f"\n{'🏈' * 40}")
        print(f"NFL STATISTICAL LEADERS - {self.current_season} Season")
        print(f"{'🏈' * 40}\n")

        for category_key, category_info in self.categories.items():
            leaders = self.fetch_espn_stats(category_key, limit)
            self.display_leaders(category_info['display'], leaders)

        print(f"\n{'=' * 80}")
        print(f"Note: Displaying sample data from 2024 NFL season for demonstration")
        print(f"{'=' * 80}\n")


def main():
    """Main entry point for the application."""
    import argparse

    parser = argparse.ArgumentParser(
        description='NFL Stat Leaders - View current NFL statistical leaders',
        formatter_class=argparse.RawDescriptionHelpFormatter,
        epilog="""
Examples:
  %(prog)s                    # Show all stat categories (top 10 each)
  %(prog)s -l 5               # Show top 5 leaders in each category
  %(prog)s -c passing         # Show only passing leaders
  %(prog)s -c rushing -l 15   # Show top 15 rushing leaders
        """
    )
    parser.add_argument(
        '-l', '--limit',
        type=int,
        default=10,
        help='Number of leaders to display per category (default: 10)'
    )
    parser.add_argument(
        '-c', '--category',
        type=str,
        choices=['passing', 'rushing', 'receiving'],
        help='Specific category to display (passing, rushing, or receiving)'
    )

    args = parser.parse_args()

    stats = NFLStatLeaders()

    if args.category:
        leaders = stats.fetch_espn_stats(args.category, args.limit)
        category_info = stats.categories[args.category]
        stats.display_leaders(category_info['display'], leaders)
    else:
        stats.display_all_leaders(args.limit)


if __name__ == "__main__":
    main()
