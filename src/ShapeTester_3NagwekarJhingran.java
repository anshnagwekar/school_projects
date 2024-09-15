import java.awt.Color;

public class ShapeTester_3NagwekarJhingran {
    public static void main(String[] args) {

        Shape shape = new Shape( 1, 2, Color.GREEN);

        Shape circle1 = new Circle(12, 1, 1, Color.BLACK);
        System.out.println(circle1.getArea());

        Shape rectangle = new Rectangle(1, 2, Color.GREEN, 10, 11);
        Shape rectangle2 = new Rectangle(1, 2, Color.GREEN, 10, 11);
        Shape rectangle3 = new Rectangle(1, 3, Color.GREEN, 10, 11);

        System.out.println(rectangle);
        System.out.println(rectangle2);
        System.out.println(rectangle3);

        System.out.println(rectangle.equals(rectangle2));
        System.out.println(rectangle.equals(rectangle3));
        System.out.println(shape.equals(rectangle));
        System.out.println(rectangle.equals(shape)); //should throw exception
    }
}

class Shape {
    private int xLoc;
    private int yLoc;
    private Color color;


    public Shape( int xLocation, int yLocation ) {
        xLoc = xLocation;
        yLoc = yLocation;
        color = Color.BLACK;
    }

    public int getX() {return xLoc;}
    public int getY() {return yLoc;}
    public Color getColor() {return color;}

    public Shape( int xLocation, int yLocation, Color c){
     xLoc = xLocation;
     yLoc = yLocation;
     color = c;
    }

    public double getArea( ) { return 0; }

    public boolean equals(Shape o){
        if(xLoc == o.getX()){
            if(yLoc == o.getY() ){
                if(color.equals(o.getColor())){
                    return true;
                }
            }
        }
        return false;
    }


    public String toString(){
        return "X Location: " + xLoc + " Y Location: " + yLoc + " Color: " + color;
    }
} // end class Shape

class Circle extends Shape{
    private double radius;

    public Circle(double radius,  int xLocation, int yLocation, Color c){
        super(xLocation, yLocation, c);
        this.radius = radius;
    }

    public double getArea(){
        return (radius * radius) * Math.PI;
    }

}

class Rectangle extends Shape
{
    private int width;
    private int length;

    public Rectangle(int xLocation, int yLocation, Color c, int length, int width){
        super(xLocation, yLocation, c);
        this.width = width;
        this.length = length;
    }

    @Override
    public boolean equals(Shape r){
        Rectangle o = (Rectangle) r;
        if(super.equals(r)){
            if(width == o.getWidth())
            {
                if(length == o.getLength()){
                    return true;
                }
            }
        }
        return false;
    }

    public int getWidth(){ return width; }
    public int getLength(){ return length; }

    @Override
    public String toString(){
        return super.toString() + " Width: " + width + " Length: " + length;
    }

}
