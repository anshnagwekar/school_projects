public class Array2DTester_3Nagwekar
{
  public static void main(String[] args)
  {
    int[][] arr =  { {1,5,7,8}, {2, 4, 6, 8}, {10, 14, 18, 22} };
    Array2DTester atest = new Array2DTester(arr);
    Location loc = atest.findSix();
    int sum = atest.sumArray();
    int sumCol = atest.sumColumn(0);
    Location loc2 = atest.findNextValue(new Location(1,2), 22);

    System.out.println("Find Six: " + loc);
    System.out.println("Sum Array: " + sum);
    System.out.println("Sum Column: " + sumCol);
    System.out.println("Find Next Value: " + loc2);
  }
}

class Array2DTester
{
  private int[][] arr;

  public Array2DTester(int[][] arr1){
    arr = new int[arr1.length][arr1[0].length];
    for(int i = 0; i < arr1.length; i ++){
      for(int j = 0; j < arr1[0].length; j ++){
        arr[i][j] = arr1[i][j];
      }
    }

  }
  public Location findSix(){
    for(int i = 0; i < arr.length; i ++){
      for(int j = 0; j < arr[0].length; j ++){
        if(arr[i][j] == 6) return new Location(i, j);
      }
    }
    return null;
  }

  public int sumArray(){
    int total = 0;
    for(int[] row : arr){
      for(int i : row){
        total += i;
      }
    }
    return total;
  }

  public int sumColumn(int col){
    int total = 0;
    for(int i = 0; i < arr.length; i ++){
      for(int j = 0; j < arr[0].length; j ++){
        if(j == col) total += arr[i][j];
      }
    }
    return total;
  }

  public Location findNextValue(Location l, int key){
    int startX = l.getRow();
    int startY = l.getCol();
  
    for(int i = startX; startX < startX+1; i ++){
      for(int j = startY;j < arr[0].length; j ++){
        if(arr[i][j] == key) return new Location(i,j);
      }
    }
    
    startX++;
    for(int i = startX; i < arr.length; i ++){
      for(int j = 0; j < arr[0].length; j ++){
        if(arr[i][j] == key) return new Location(i, j);
      }
    }

    return null;
  }

}

class Location {
  private int r;
  private int c;

  public Location( int row, int col) {
    r = row;
    c = col;
  }

  public int getRow() { return r; }
  public int getCol() { return c; }

  public String toString(){
    return "Row: " + r + "\tCol: " + c;
  }
}
