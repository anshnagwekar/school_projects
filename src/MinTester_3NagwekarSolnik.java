import java.util.ArrayList;

/**
 * Name: Ansh Nagwekar and Charles Solnik
 * Assignment AList-A5: Find2ndMin-PP
 */

public class MinTester_3NagwekarSolnik {

    /**
     @param ints An arrayList with at least 2 elements (precondition).
     Postcondition: The arrayList ints is not mutilated or disturbed in any way.
     @return the 2nd smallest value in the array (or the smallest if the min value occurs more than once)
     */
    public static int find2ndMin( ArrayList<Integer> ints ){
        int min = ints.get(0);
        int secondMin = ints.get(1);
        if (min > secondMin){
            min = ints.get(1);
            secondMin = ints.get(0);
        }
        for ( int i = 2; i < ints.size(); i++){
            if (ints.get(i) < min) min = ints.get(i);
            else if (ints.get(i) < secondMin) secondMin = ints.get(i);
        }
        return secondMin;
    }

    public static void main( String[] args)
    {

        ArrayList<Integer> stuff = new ArrayList<Integer>();
        stuff.add(-2);
        stuff.add(12);
        stuff.add(22);
        stuff.add(17);
        stuff.add(19);
        stuff.add(-10);
        stuff.add(-2);
        System.out.println("Test 1: 2nd smallest is: " + find2ndMin(stuff) );

        stuff = new ArrayList<Integer>();
        stuff.add(-2);
        stuff.add(12);
        stuff.add(22);
        stuff.add(17);
        stuff.add(19);
        stuff.add(-1);
        stuff.add(-2);
        System.out.println("Test 2: 2nd smallest is: " + find2ndMin(stuff) );

        stuff = new ArrayList<Integer>();
        stuff.add(-2);
        stuff.add(12);
        stuff.add(22);
        stuff.add(17);
        stuff.add(19);
        stuff.add(-1);
        stuff.add(999999);
        System.out.println("Test 3: 2nd smallest is: " + find2ndMin(stuff) );
    }
}
