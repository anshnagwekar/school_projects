/**
 * Name: Ansh Nagwekar
 * Assignment: AList-A3: In class pgm
 */

import java.util.ArrayList;

public class ArrayListCompareDemo_3Nagwekar
{

    public static String findMax(ArrayList<String> arr){
        String s = arr.get(0);

        for(String c : arr){
            if(c.compareTo(s)>0) s = c;
        }
        return s;
    }
    public static void main(String[] args){
        ArrayList<String> aList = new ArrayList<String>();
        aList.add("Car");
        aList.add("Truck");
        aList.add("Monkey");
        aList.add("Airplane");
        aList.add("Soldier");
        for(String c : aList){
            System.out.println(c);
        }
        System.out.println();
        aList.remove(1);
        aList.set( 3, "Biplane");
        aList.add( 1, "Trackpad");
        for(String c : aList){
            System.out.println(c);
        }
        System.out.println();
        findMax(aList);

    }
}
