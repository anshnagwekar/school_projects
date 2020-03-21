import java.util.Arrays;

public class SortPerformanceTester_3Nagwekar {

    public static void main( String[] args ) {
        final int SIZE = 100000;
        Computer[] arr = new Computer[SIZE];
        
        for( int i = 0; i < arr.length; i++ ) {
            arr[i] = new Computer((int)(Math.random()*100000));  
        }

        // Test using arrays' sort method
        long start = System.currentTimeMillis();
        Arrays.sort( arr ); 
        long stop = System.currentTimeMillis();
        System.out.println("It took " + (stop - start) + "ms to sort " + SIZE + " records.");

        // Repopulate the array to test a 2nd time:
        for( int i = 0; i < arr.length; i++ ) {
            arr[i] = new Computer((int)(Math.random()*100000)); 
        }
        // Test using your Selection Sort method:
        start = System.currentTimeMillis();
        organize(arr);
        stop = System.currentTimeMillis();
        System.out.println("It took " + (stop - start) + "ms to sort " + SIZE + " records.");

        //Just to check to see if organize works(prints first 10 elements' ram)
        for( int i = 0; i < 10; i++ ) {
            System.out.println(arr[i].getRam());
        }
    }

    public static void organize(Computer[] arr){
        Computer temp = arr[0];
        int min = 0;
        for(int i = 0; i < arr.length; i++){
            min = i;
            for(int j = i; j < arr.length; j ++){
                if (arr[min].compareTo(arr[j]) >= 0) {
                    min = j;
                }
            }
            temp = arr[i];
            arr[i] = arr[min];
            arr[min] = temp;
        }
    }

}

class Computer implements Comparable
{
    private int ram;

    public Computer(int ram){
        this.ram = ram;
    }

    public int getRam(){
        return ram;
    }
    public int compareTo(Object other){
        Computer cow = (Computer)other;

        int ram1 = this.ram;
        int ram2 = cow.getRam();

        return ram1 - ram2;
    }
}

