import java.util.Arrays;

public class InterviewTester {
    public static void main(String[] args) {
        int[] arr = {10, 20, 0, 12, 23, 0};
        int[] arr2 = new int[arr.length];
        int j = 0;
        int temp;

        for(int i : arr){
            if(i != 0){
                arr2[j] = i;
                j++;
            }
        }

        for(int i = 0; i < j; i ++){
            for(int k = i; k < j; k++){
                if(arr2[k] < arr2[i]){
                    temp = arr2[i];
                    arr2[i] = arr2[k];
                    arr2[k] = temp;
                }
            }
        }
        /**
        int[] arr3 = new int[j];

        for(int i = 0; i < j; i ++){
            arr3[i] = arr2[i];
        }

        Arrays.sort(arr3);

        for(int i = 0; i < j; i ++){
            arr2[i] = arr3[i];
        }
        */

        while(j<arr.length){
            arr2[j] = 0;
            j++;
        }

        for(int i : arr2){
            System.out.println(i);
        }


    }
}
