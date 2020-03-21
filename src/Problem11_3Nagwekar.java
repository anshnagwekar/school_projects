/**
* Name: Ansh Nagwekar
* Project: IFaces-A2: Mini Programming Project
*/

/**
 * Testing public class for the interface implementing classes
 * @author Ansh Nagwekar
 */
public class Problem11_3Nagwekar
{
    /**
     * Executable that creates and object of each class and tests methods
     * @param args
     */
    public static void main(String[] args) {
        DefaultFormatter def = new DefaultFormatter();
        System.out.println(def.format(2047));

        DecimalSeparatorFormatter dec = new DecimalSeparatorFormatter();
        System.out.println(dec.format(2047));

        BaseFormatter base = new BaseFormatter(2);
        System.out.println(base.format(2047));

        AccountingFormatter acc = new AccountingFormatter();
        System.out.println(acc.format(-2047));
    }

}

/**
 * Contains one format method for classes that implement.
 */
interface NumberFormatter
{
    public String format(int n);
}

/**
 * Returns number as a default state.
 */
class DefaultFormatter implements NumberFormatter
{

    /**
     * @param n, the number
     * @return number as a String
     */
    public String format(int n){
        return "" + n;
    }
}

/**
 * Returns negative number with positive correspondent with parenthesis
 */
class AccountingFormatter implements NumberFormatter
{

    /**
     * @param n, given number
     * @return number with positive value and parenthesis around it
     */
    public String format(int n){
        n = n * -1;
        return "(" + n + ")";
    }
}

/**
 * Converts number to decimal/comma separator form
 */
class DecimalSeparatorFormatter implements NumberFormatter
{

    /**
     * @param n, given number
     * @return String with commas every thousands place
     */
    public String format(int n){

        String newS = "" + n;
        int seps= (int)Math.floor((newS.length()-1)/3); // Calculates amount of commas needed
        String s = newS.substring(0,newS.length()-(seps*3)); // String before first thousands place
        while (seps>0)
        {
             s += ","+ newS.substring(newS.length()-(seps*3),newS.length()-((seps-1)*3));
            seps--;
        }
        return s;
    }

}

/**
 * Converts number into given base form
 */
class BaseFormatter implements NumberFormatter
{
    private int base;

    /**
     * Constructor that sets base to given number
     * @param n, given number
     */
    public BaseFormatter(int n){
        base = n;
    }

    /**
     * @param n, given number
     * @return number converted to base of the class
     */
    public String format(int n){
        return Integer.toString(n, base);
    }
}


