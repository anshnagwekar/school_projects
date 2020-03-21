import java.util.ArrayList;

/**
 * Name: Ansh Nagwekar
 * Assignment: DeckTesterAL
 */

/**
 * Tests Deck class that calls Card class
 */
public class DeckTesterAL_3Nagwe {

    /**
     * Deals card 42 times and prints the rest of the deck
     */
    public static void main(String[] args)
    {
        Deck newDeck = new Deck();
        for(int i = 0; i < 42; i++)
        {
            System.out.println( "Dealt card: " + newDeck.deal() );
        }
        System.out.println(newDeck);
    }
}







