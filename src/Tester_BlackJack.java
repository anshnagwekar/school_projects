public class Tester_BlackJack {
    public static void main(String[] args){
        Deck deck = new Deck();
        Player player = new Player("ANsh", 21);
        for(int i = 0; i < 15; i ++){
            player.addCard(deck.deal());
        }
        System.out.println(player.displayHand());

    }
}

