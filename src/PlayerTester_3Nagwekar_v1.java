import java.util.ArrayList;
import java.util.Scanner;

/**
 * Name: Ansh Nagwekar
 * Assignment: AList-A6: Player class
 */

/**
 * Tests out methods of Player and uses Deck class for cards.
 * @author: Ansh Nagwekar
 */

/**
 *

public class PlayerTester_3Nagwekar_v1 {

    /**
     * Main method that deals cards and displays hand value, and asks to hit.
     *
     * @param args


    public static void main(String[] args) {
        Scanner scan = new Scanner(System.in);

        Deck myDeck = new Deck();
        Player myHand = new Player(myDeck.deal(), myDeck.deal());
        Player dealerHand = new Player(myDeck.deal(), myDeck.deal());

        System.out.println("My Hand: " + myHand.displayHand());
        System.out.println("Dealer's Hand: " + dealerHand.displayHand());

        System.out.println("My Hand Value: " + myHand.getHandValue());
        System.out.println("Dealer Hand Value: " + dealerHand.getHandValue());

        System.out.println(myHand.getUserInput(scan));

    }

}

 */