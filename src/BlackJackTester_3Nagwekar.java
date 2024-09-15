import java.util.ArrayList;
import java.util.Scanner;

/**
 * Name: Ansh Nagwekar
 * Assignment: BlackJack Tester
 * Please Read: Includes Betting(with Money instead of chips)
 *              Includes Multiplayer option
 *              Uses Try...Catch for illegal Scan inputs
 *              Has a GUI to some extent(you can see the cards)
 */


/**
 * Executable class that tests Blackjack class
 * @author: Ansh Nagwekar
 */
public class BlackJackTester_3Nagwekar
{

    /**
     * Declares scanner and creates Blackjack object
     * @param args
     */
    public static void main(String[] args)
    {
        Scanner scan = new Scanner(System.in);
        BlackJack blackJack = new BlackJack(scan);
    }
}

/**
 * Blackjack class that takes Deck, Dealer, and any amount of Players
 */
class BlackJack
{
    private ArrayList<Player> players = new ArrayList<Player>();
    private Deck theDeck = new Deck();
    private Dealer dealer = new Dealer();

    /**
     * Constructor that runs the whole blackjack game
     * @param scan declared in public class
     */
    public BlackJack(Scanner scan)
    {
        //banner
        System.out.println("\n" +
        ".------..------..------..------..------..------..------..------..------.\n" +
        "|B.--. ||L.--. ||A.--. ||C.--. ||K.--. ||J.--. ||A.--. ||C.--. ||K.--. |\n" +
        "| :(): || :/\\: || (\\/) || :/\\: || :/\\: || :(): || (\\/) || :/\\: || :/\\: |\n" +
        "| ()() || (__) || :\\/: || :\\/: || :\\/: || ()() || :\\/: || :\\/: || :\\/: |\n" +
        "| '--'B|| '--'L|| '--'A|| '--'C|| '--'K|| '--'J|| '--'A|| '--'C|| '--'K|\n" +
        "`------'`------'`------'`------'`------'`------'`------'`------'`------'\n");

        addPlayer(scan);
        game(scan);
    }

    public void game(Scanner scan)
    {
        boolean game = true;
        Card dealtCard;
        String playOrNo;
        String decision;
        boolean recurse = true;
        int bet = 0;

        //plays game until players left table or no one wants to play
        while (game && players.size() > 0) {

            //betting system, loops each player
            for (int i = 0; i < players.size(); i++)
            {
                if (players.get(i).getMoney() == 0)
                {
                    //Removes players from table with no money
                    System.out.println("Sorry, no money, " + players.get(i).getName());
                    players.remove(i);
                    i--;
                } else {
                    while (true)
                    {
                        System.out.println(players.get(i).getName() + ", what is your bet?(enter int)");
                        System.out.println("Money: $" + players.get(i).getMoney());
                        try
                        {
                            bet = Integer.parseInt(scan.next());
                        }catch(NumberFormatException e)
                        {
                            System.out.println("Not a number.");
                            continue;
                        }
                        players.get(i).getBet(bet);
                        if (bet > players.get(i).getMoney() || bet <= 0)
                        {
                            System.out.println("Not a valid amount");
                        } else break;
                    }
                }
            }

            //Only runs if any players at table
            if(players.size() > 0)
            {
                //Dealer reveals one card
                System.out.println("-----------------------------------------------------------------");
                System.out.println("Dealer's Second Card(one card covered): | " + dealer.displayHand());
                System.out.println("-----------------------------------------------------------------");

                //Player calculations plus hit or stay
                for (Player player : players)
                {
                    System.out.println("\n-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-");

                    System.out.println(player.getName() + ", it is your turn");
                    System.out.println(player.displayHand());
                    System.out.println(player.getName() + "'s Hand value: " + player.getHandValue() + "\n");
                    if(player.getHandValue() == 21){
                        System.out.println("You have hit a natural blackjack! Enter your reaction to continue");
                        String placeH = scan.next();
                    }
                    while (recurse && player.getHandValue() < 21)
                    {
                        decision = player.getUserInput(scan);
                        if (decision.equals("hit"))
                        {
                            dealtCard = theDeck.deal();
                            System.out.println("hit, and you get a " + dealtCard + "\n");
                            player.addCard(dealtCard);
                            System.out.println((player.displayHand()));
                            System.out.println(player.getName() + "'s Hand value: " + player.getHandValue());
                        } else recurse = false;
                    }
                    recurse = true;
                    System.out.println("-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-\n");
                }

                //Remove all busted players
                for(int i = 0; i < players.size(); i ++){
                    if(players.get(i).getHandValue() > 21){
                        System.out.println(players.get(i).getName() + " has busted! Dealer wins!");
                        players.get(i).loseMoney();
                        System.out.println(players.get(i).getName() +" leaves with $" + players.get(i).getMoney());
                        players.get(i).returnWins();
                        players.remove(i);
                        i--;
                    }
                }

                System.out.println("\n--------------------------------------------------");
                if(!dealer.needCard() || players.size() <= 0) System.out.println("Dealer stays.");
                else {
                    while (dealer.needCard())
                    {
                        dealtCard = theDeck.deal();
                        System.out.println("Dealer Hits, and gets " + dealtCard);
                        dealer.addCard(dealtCard);
                        System.out.println(dealer.displayHand());
                    }
                }
                System.out.println("--------------------------------------------------\n");

                System.out.println("/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+");
                System.out.println("Dealers end hand: " + dealer.displayHandEnd());
                System.out.println("/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+/+");

                //Compares dealer with all players
                if(players.size() > 0) {
                    for (int i = 0; i < players.size(); i++) {
                        if (dealer.getHandValue() > 21) {
                            System.out.println("Dealer busts. " + players.get(i).getName() + " wins!");
                            players.get(i).addMoney();
                            players.get(i).addWins();
                        } else if (players.get(i).getHandValue() > dealer.getHandValue()) {
                            System.out.println(players.get(i).getName() + " has beat the dealer!");
                            players.get(i).addMoney();
                            players.get(i).addWins();
                        } else if (players.get(i).getHandValue() < dealer.getHandValue()) {
                            System.out.println("Dealer beats " + players.get(i).getName());
                            players.get(i).loseMoney();
                        } else if (players.get(i).getHandValue() == dealer.getHandValue()) {
                            System.out.println("Dealer ties with " + players.get(i).getName());
                        }
                        if (players.get(i).getHandValue() == 21) {
                            System.out.println("BONUS BUCKS to "+players.get(i).getName()+" for achieving 21!");
                            players.get(i).add21Money();
                        }
                    }
                    //players' wins
                    System.out.println();
                    returnPlayerWins();
                    System.out.println();
                    returnPlayerMoney();
                    System.out.println();
                }

                //ask to play again with while loop
                if(players.size() > 0)
                {
                    System.out.println("play again?(press no to stop, anything to continue: ");
                    playOrNo = scan.next();
                    if (playOrNo.equals("no")) {
                        game = false;
                        System.out.println("Thanks for playing!");
                    }
                    else {
                        //resets game settings
                        for (Player p : players) {
                            p.resetCards();
                        }
                        dealer.resetCards();
                        for (int i = 0; i < 2; i++) {
                            for (Player player : players) {
                                dealtCard = theDeck.deal();
                                player.addCard(dealtCard);
                            }
                            dealtCard = theDeck.deal();
                            dealer.addCard(dealtCard);
                        }
                    }
                }
                else {
                    System.out.println("\nLooks like everyone has busted/out of money. Sorry!");
                    System.out.println("Thanks for playing!");
                }

            }
            resetDeck();
        }

    }

    /**
     * Adds players to table, takes names
     *
     * @param scan a Scanner object
     */
    public void addPlayer(Scanner scan)
    {

        String name;
        Card dealtCard;
        int i = 0;
        int num  = 0;
        int money = 0;

        while(true)
        {
            System.out.println("How many players?");
            try{
                num = Integer.parseInt(scan.nextLine());
                if(num > 0 && num < 9){
                    break;
                }
                else System.out.println("Enter between 1 - 8");
            }catch (Exception e){
                System.out.println("That's not a number");
            }
        }

        while (i < num)
        {
            System.out.println("Player " + (i + 1) + ", what is your name?(string)");
            name = scan.nextLine();
            while(true)
            {
                System.out.println("What is your money?(int)");
                try
                {
                    money = Integer.parseInt(scan.nextLine());
                    break;
                } catch (NumberFormatException e)
                {
                    System.out.println("That's not a number");
                }
            }
            System.out.println();
            players.add(new Player(name, money));
            i++;
        }

        //deals cards out one at a time(alternate)
        for(int j = 0; j < 2; j ++)
        {
            for (Player player : players)
            {
                dealtCard = theDeck.deal();
                player.addCard(dealtCard);
            }
            dealtCard = theDeck.deal();
            dealer.addCard(dealtCard);
        }
    }

    /**
     * Checks if deck has less than half, then resets the deck
     */
    public void resetDeck()
    {
        if (theDeck.deckAmt() <= 26)
        {
            theDeck = new Deck();
        }
    }

    /**
     * Returns all player wins
     */
    public void returnPlayerWins()
    {
        for (Player player : players)
        {
            System.out.println(player.getName() + "'s Wins: " + player.returnWins());
        }
    }

    public void returnPlayerMoney()
    {
        for (Player player : players)
        {
            System.out.println(player.getName() + "'s money: $" + player.getMoney());
        }
    }

}

/**
 * Dealer Class that holds dealers's hand and calculates dealer hand value
 */
class Dealer
{
    private ArrayList<Card> hand = new ArrayList<>();
    private int val;


    /**
     * Checks to see if value is 16 or below or 17 with one Ace
     * @return if dealer needs card
     */
    public boolean needCard()
    {
        int isAce = 0;
        for(Card c : hand)
        {
            if(c.getRank() == 1){
                isAce ++;
            }
        }
        if ((getHandValue() <= 16) || (getHandValue() == 17 && isAce == 1))
        {
            return true;
        }else return false;
    }
    /**
     * Prints out the hand in a nice format except bottom card
     * @return string with cards
     */
    public String displayHand()
    {
        String s = "";
        for(int i = 1; i < hand.size(); i++ ){
            s += hand.get(i) + " | ";
        }
        for(int i = 1; i < hand.size(); i++ ){
            s += "\n" + hand.get(i).getASQIIcard();
        }
        return "Hand: | " + s;
    }

    /**
     * Adds the given card to dealer hand
     * @param c the card to add
     */
    public void addCard( Card c){
        hand.add(c);
    }

    /**
     * Loops through hand and calculates hand value with standard Blackjack rules
     * @return the hand value
     */
    public int getHandValue(){
        val = 0;
        int aceCount = 0;
        for (Card c : hand){
            if(c.getRank() <= 10 && c.getRank() != 1){
                val += c.getRank();
            }
            if(c.getRank() > 10){
                val += 10;
            }
            if (c.getRank() == 1){
                val += 1;
                aceCount++;
            }
        }
        if(aceCount > 0 && (val + 10 <= 21)){
            val += 10;
        }

        return val;
    }

    /**
     * Same as display but includes all cards
     * @return hand value and cards
     */
    public String displayHandEnd(){
        String s = "";
        for(int i = 0; i < hand.size(); i++ ){
            s += hand.get(i) + " | ";
        }
        for(Card c: hand){
            s += "\n" + c.getASQIIcard();
        }
        return "| " + s + "\nDEALER Hand Value : " + getHandValue();
    }

    /**
     * Clears ArrayList hand of all Card objects
     */
    public void resetCards(){
        hand.clear();
    }

}

/**
 * Player Class that holds player's hand and calculates hand value
 */
class Player
{
    private ArrayList<Card> hand = new ArrayList<>();
    private int val;
    private String name;
    private int money = 0;
    private int bet;
    private int wins = 0;

    /**
     * Takes in two cards and adds to ArrayList hand
     * @param name, the player's name
     * @param money, bank deposit
     */
    public Player( String name, int money){
        {
            this.name = name;
            this.money = money;
        }
    }

    /**
     * Prints out the hand in a nice format
     * @return string with cards
     */
    public String displayHand(){
        String s = "";
        for(Card c: hand){
            s += c + " | ";
        }
        for(Card c: hand){
            s += "\n" + c.getASQIIcard();
        }
        return "Hand: | " + s;
    }


    /**
     * Adds the given card to dealer hand
     * @param c the card to add
     */
    public void addCard( Card c){
        hand.add(c);
    }

    /**
     * Checks to see if user wants to hit(more cards) or stay(no more)
     * @param scan, Scanner clasds
     * @return true or false, depending on input
     */
    public String getUserInput( Scanner scan ){
        System.out.println("Hit(hit in any case) or stay?(type anything to stay)");
        String in = scan.next();
        if (in.equalsIgnoreCase("hit")) return "hit";
        else return "stay";
    }

    /**
     * Loops through hand and calculates hand value with standard Blackjack rules
     * @return the hand value
     */
    public int getHandValue(){
        val = 0;
        int aceCount = 0;
        for (Card c : hand){
            if(c.getRank() <= 10 && c.getRank() != 1){
                val += c.getRank();
            }
            if(c.getRank() > 10){
                val += 10;
            }
            if (c.getRank() == 1){
                val += 1;
                aceCount++;
            }
        }
        if(aceCount > 0 && (val + 10 <= 21)){
            val += 10;
        }

        return val;
    }

    /**
     * @return the name variable
     */
    public String getName(){
        return name;
    }

    /**
     * Adds bet that is placed
     */
    public void addMoney(){
        money += bet;
    }

    /**
     * Adds extra money on bet that is placed if scored 21
     */
    public void add21Money(){
        money += (bet/2);
    }

    /**
     * Subtracts bet that was given
     */
    public void loseMoney(){
        money -= bet;
    }

    /**
     * Asks user for their bet
     * @param money, player's bet
     */
    public void getBet(int money){
        bet = money;
    }

    /**
     * clears hand of all Card objects
     */
    public void resetCards(){
        hand.clear();
    }

    /**
     * @return amount of money in bank
     */
    public int getMoney(){
        return money;
    }

    /**
     * Adds 1 to amount of wins
     */
    public void addWins(){
        wins++;
    }

    /**
     * @return amount of winsk
     */
    public int returnWins(){
        return wins;
    }
}

/**
 * Card class that stores teh rank and suite of a card.
 * Used in Deck class and Player class
 */
class Card
{
    private int rank;
    private String suite;

    /**
     Constructor where user enters card rank and suite and
     Card instance varaibles acquire those values.
     @param rank, the rank
     @param suite, the suite
     */
    public Card(int rank, String suite)
    {
        this.rank = rank;
        this.suite = suite;
    }

    /**
     toString method that returns rank and suite, and if the card
     is special, it returns the appropriate rank
     */
    public String toString()
    {
        if (rank == 1) return "Ace of " + suite;
        if (rank == 11) return "Jack of " + suite;
        if (rank == 12) return "Queen of " + suite;
        if (rank == 13) return "King of " + suite;
        return rank + " of " + suite;
    }

    /**
     * Returns rank for Blackjack value calculations
     * @return rank
     */

    public int getRank(){
        return rank;
    }

    public String getASQIIcard(){
        String s = "";

        switch (rank){
            case 1: s = ".------.\n" +
                    "|A.--. |\n" +
                    "| (\\/) |\n" +
                    "| :\\/: |\n" +
                    "| '--'A|\n" +
                    "`------'";
                    break;
            case 2: s =
                    ".------.\n" +
                    "|2.--. |\n" +
                    "| (\\/) |\n" +
                    "| :\\/: |\n" +
                    "| '--'2|\n" +
                    "`------'";
                    break;
            case 3: s = ".------.\n" +
                    "|3.--. |\n" +
                    "| :(): |\n" +
                    "| ()() |\n" +
                    "| '--'3|\n" +
                    "`------'";
                    break;
            case 4: s = ".------.\n" +
                    "|4.--. |\n" +
                    "| :/\\: |\n" +
                    "| :\\/: |\n" +
                    "| '--'4|\n" +
                    "`------'";
                    break;
            case 5: s = ".------.\n" +
                    "|5.--. |\n" +
                    "| :/\\: |\n" +
                    "| (__) |\n" +
                    "| '--'5|\n" +
                    "`------'";
                    break;
            case 6: s = ".------.\n" +
                    "|6.--. |\n" +
                    "| (\\/) |\n" +
                    "| :\\/: |\n" +
                    "| '--'6|\n" +
                    "`------'";
                    break;
            case 7: s = ".------.\n" +
                    "|7.--. |\n" +
                    "| :(): |\n" +
                    "| ()() |\n" +
                    "| '--'7|\n" +
                    "`------'";
                    break;
            case 8: s = ".------.\n" +
                    "|8.--. |\n" +
                    "| :/\\: |\n" +
                    "| :\\/: |\n" +
                    "| '--'8|\n" +
                    "`------'";
                    break;
            case 9: s = ".------.\n" +
                    "|9.--. |\n" +
                    "| :/\\: |\n" +
                    "| (__) |\n" +
                    "| '--'9|\n" +
                    "`------'";
                    break;
            case 10: s = ".------.\n" +
                    "|10---.|\n" +
                    "| :/\\: |\n" +
                    "| (__) |\n" +
                    "|.---10|\n" +
                    "`------'";
                    break;
            case 11: s = ".------.\n" +
                    "|J.--. |\n" +
                    "| :(): |\n" +
                    "| ()() |\n" +
                    "| '--'J|\n" +
                    "`------'";
                    break;
            case 12: s = ".------.\n" +
                    "|Q.--. |\n" +
                    "| (\\/) |\n" +
                    "| :\\/: |\n" +
                    "| '--'Q|\n" +
                    "`------'";
                    break;
            case 13: s = ".------.\n" +
                    "|K.--. |\n" +
                    "| :/\\: |\n" +
                    "| :\\/: |\n" +
                    "| '--'K|\n" +
                    "`------'";
                    break;
        }
        return s;
    }
}

/**
 * Deck class that simulates the deck with an Array List of 52 cards
 */
class Deck {
    private ArrayList<Card> cards = new ArrayList<Card>(52);
    private String[] suiteType = {"Clubs", "Spades", "Diamonds", "Hearts"};
    private int cardsAmt = 52;

    public Deck( ) {
        for (int i = 0; i < suiteType.length; i++) {
            for (int j = 1; j <= 13; j++) {
                cards.add(new Card(j, suiteType[i]));
            }
        }
        shuffle();
    }

    /**
     Method that removes the top card from the deck(index 0)
     */
    public Card deal() {
        Card temp = cards.get(0);
        cards.remove(0);
        cardsAmt--;
        return temp;

    }

    /**
     * Concatenates all Card names into strings
     * @return the string with Card objects
     */
    public String toString() {
        String s = "";
        for(Card c : cards){
            s += "\n" + c;
        }
        return s;
    }

    /**
     Method that first resets the deck with all values in dealtCards
     and then uses Math.random to swap values to "shuffle" deck
     */
    private void shuffle()
    {
        // actual shuffler uses swap 52 times with random numbers
        Card temp;
        int rand1 = 0;
        int rand2 = 0;
        for(int i = 0;i < cards.size();i++)
        {
            rand1 = (int)(Math.random()*cards.size());
            rand2 = (int)(Math.random()*cards.size());

            temp = cards.get(rand1);
            cards.set( rand1 , cards.get(rand2));
            cards.set( rand2 , temp);
        }

    }

    /**
     * @return amount of Cards in deck
     */
    public int deckAmt(){
        return cardsAmt;
    }

}
