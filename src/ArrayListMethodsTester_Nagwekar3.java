import java.util.ArrayList;
import java.util.Arrays;

/**
 * Name: Ansh Nagwekar
 * Assignment: AList-A4: Book Pgm
 */

/**
 * Public class that tests out every method of ArrayList class
 * @author: Ansh Nagwekar
 */
public class ArrayListMethodsTester_Nagwekar3 {

    /**
     * Calls each method and displays new array/value from the method
     * @param args
     */
    public static void main( String[] args )
        {
            Integer[] testData = {3, 6, 9, 2, 1, 4, 7, 5};
            ArrayListMethods methods = new ArrayListMethods( testData );

            System.out.println("Original array: ");
            methods.display();

            System.out.println("Swap First and Last: ");
            methods.swapFirstAndLast();
            methods.display();

            System.out.println("Shift Right: ");
            methods.shiftRight();
            methods.display();

            System.out.println("Replace all evens with 0: ");
            methods.replaceEven();
            methods.display();

            System.out.println("Replace number is neighbor is larger: ");
            methods.findLargerAdjacent();
            methods.display();

            System.out.println("Set all even elements to the front: ");
            methods.setFrontToEven();
            methods.display();

            System.out.println("Remove the middle elements: ");
            methods.removeMiddle();
            methods.display();

            System.out.println("Second largest value in array: ");
            System.out.println(methods.findSecondLargest());

            System.out.println("Check if elements are increasing: ");
            System.out.println(methods.isIncreasing());

            System.out.println("Check if any adjacent elements are duplicate: ");
            System.out.println(methods.isAdjacentDuplicates());

            System.out.println("Check if any elements are duplicate: ");
            System.out.println(methods.isDuplicate());
        }

}

class ArrayListMethods{

    private ArrayList<Integer> values;
    private Integer[] arr;

    /**
     Initializes the values list
     @param data the integer array used to initialize the values list
     */
    public ArrayListMethods( Integer[] data )
    {
        values = new ArrayList<Integer>();
        arr = data;
        for( int i : data ) values.add( i );
    }

    /**
     * Resets ArrayList and prints out the value of ArrayList
     */
    public void display()
    {
        System.out.println( values );
        values = new ArrayList<>(Arrays.asList(arr));
    }

    /**
     * E7.10a) Swap the first and last elements in the array.
     */
    public void swapFirstAndLast()
    {
        int temp = values.get(0);
        values.set( 0, values.get(values.size()-1));
        values.set( values.size()-1, temp);
    }

    /**
     * E7.10b) Shift all elements to the right by one and move the last element into the first
     * position.
     */
    public void shiftRight(){
        int temp = values.get(values.size()-1);
        for (int i = values.size()-1; i > 0; i --) {
            values.set ( i, values.get(i-1));
        }
        values.set( 0, temp );
    }

    /**
     * E7.10c) Replace all even elements with 0.
     */
    public void replaceEven(){
        for(int i= 0; i < values.size(); i ++){
            if(values.get(i)%2==0){
                values.set( i, 0);
            }
        }
    }

    /**
     * E7.10d) Replace each element except the first and last by the larger of its two neighbors.
     */
    public void findLargerAdjacent(){
        for (int i = 1; i < values.size()-1; i ++){
            if(values.get(i-1) > values.get(i)) values.set( i, values.get(i-1));
            else if(values.get(i+1) > values.get(i)) values.set( i, values.get(i+1));
        }
    }

    /**
     * E7.10e) Remove the middle element if the array length is odd, or the middle two elements
     * if the length is even.
     */
    public void removeMiddle(){
        if(values.size() % 2 == 0){
            values.remove(values.size()/2);
            values.remove(values.size()/2);
        }
        else values.remove(values.size()/2);
    }

    /**
     * E7.10f) Move all even elements to the front, otherwise preserving the order of the elements.
     */
    public void setFrontToEven(){
        ArrayList<Integer> setArr = new ArrayList<>();
        for(int i = 0; i < values.size(); i ++){
            if(values.get(i)%2==0) {
                setArr.add(values.get(i));
                values.remove(values.get(i));
            }
        }
        for(int i = 0; i < values.size(); i ++){
            setArr.add(values.get(i));
        }
        values = setArr;
    }

    /**
     * E7.10g) Iterates through every value in the ArrayList
     * @return the second max value
     */
    public int findSecondLargest(){
        int max = values.get(0);
        int secMax = values.get(0);
        for(int i = 0; i < values.size(); i ++){
            if(max < values.get(i)){
                max = i;
            }
            else if (secMax < values.get(i)){
                secMax = i;
            }
        }
        return secMax;
    }

    /**
     * E7.10h) Iterates through every value in the ArrayList
     * @return the boolean if value is increasing through ArrayList
     */
    public boolean isIncreasing(){
        boolean flag = true;
        for(int i = 1; i < values.size(); i ++){
            if( values.get(i) > values.get(i-1)) flag = true;
            else return false;
        }
        return flag;
    }

    /**
     * E7.10i) Iterates through every value in the ArrayList
     * @return if two adjacent values in ArrayList are duplicate
     */
    public boolean isAdjacentDuplicates(){
        for(int i = 1; i < values.size(); i ++){
            if (values.get(i) == values.get(i-1)) return true;
        }
        return false;
    }

    /**
     * E7.10j) Iterates through every value in the ArrayList
     * @return if any two values in ArrayList are duplicate
     */
    public boolean isDuplicate(){
        for(int i = 0; i < values.size(); i ++){
            for(int j = 1; j < values.size()-i; j ++){
                if (values.get(i) == values.get(j+i)) return true;
            }
        }
        return false;
    }
}
