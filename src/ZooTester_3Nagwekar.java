import java.util.ArrayList;

public class ZooTester_3Nagwekar {
    public static void main(String[] args) {
        Animal lion = new Lion("Nelly", 20);
        Animal monkey = new Monkey("Bob", 30);
        Animal wolf = new Wolf("Ryan", 10);
        Animal horse = new Horse("Squidward", 2);
        Animal orangutan = new Orangutan("DAH", 29, 40);

        ArrayList<Animal> animals = new ArrayList<>();
        animals.add(lion);
        animals.add(monkey);
        animals.add(wolf);
        animals.add(horse);
        animals.add(orangutan);

        for(Animal animal : animals){
            System.out.println(animal);
            animal.speak();
        }

        System.out.println();

        Lion lion2 = (Lion) animals.get(0);
        lion2.roar();
        Monkey monk2 = (Monkey) animals.get(1);
        monk2.screech();
        Wolf wolf2 = (Wolf) animals.get(2);
        wolf2.howl();
        Horse horse2 = (Horse) animals.get(3);
        horse2.neigh();
        Orangutan monk3 = (Orangutan) animals.get(4);
        monk3.screech();
        monk3.swing();
    }
}

class Animal
{
    private String name;

    public Animal(String name){
        this.name = name;
    }

    public void speak(){
        System.out.println("");
    }

    public String toString(){
        return name;
    }
}

class Lion extends Animal
{
    private int roarPower;

    public Lion(){
        super("LION");
        roarPower = 1;
    }

    public Lion(String name, int roar)
    {
        super(name);
        roarPower = roar;
    }

    @Override
    public void speak(){
        System.out.println(super.toString() + " says Hello!");
    }

    @Override
    public String toString(){
        return super.toString() + " is a Lion with roar power of " + roarPower;
    }

    public void roar(){
        System.out.println(super.toString() + " roars with a power of " + roarPower);
        System.out.println("RAWWWWWWR");
    }
}

class Monkey extends Animal
{
    private int screechPower;

    public Monkey(){
        super("MONKEY");
        screechPower = 1;
    }

    public Monkey(String name, int screech)
    {
        super(name);
        screechPower = screech;
    }

    @Override
    public void speak(){
        System.out.println(super.toString() + " says Hello!");
    }

    @Override
    public String toString(){
        return super.toString() + " is a Monkey with screech power of " + screechPower;
    }

    public void screech(){
        System.out.println(super.toString() + " screeches with a power of " + screechPower);
        System.out.println("SCREEEEEE");
    }

    public String getName(){
        return super.toString();
    }

    public int getScreech(){
        return screechPower;
    }
}

class Wolf extends Animal
{
    private int howlPower;

    public Wolf(){
        super("WOLF");
        howlPower = 1;
    }

    public Wolf(String name, int howl) {
        super(name);
        howlPower = howl;
    }

    @Override
    public void speak(){
        System.out.println(super.toString() + " says Hello!");
    }

    @Override
    public String toString(){
        return super.toString() + " is a Wolf with howl power of " + howlPower;
    }

    public void howl(){
        System.out.println(super.toString() + " howls with a power of " + howlPower);
        System.out.println("AWOOOOOOOO");
    }
}

class Horse extends Animal
{
    private int neighPower;

    public Horse(){
        super("HORSE");
        neighPower = 1;
    }

    public Horse(String name, int neigh)
    {
        super(name);
        neighPower = neigh;
    }

    @Override
    public void speak(){
        System.out.println(super.toString() + " says Hello!");
    }

    @Override
    public String toString(){
        return super.toString() + " is a Horse with neigh power of " + neighPower;
    }

    public void neigh(){
        System.out.println(super.toString() + " neighs with a power of " + neighPower);
        System.out.println("NEIGGGGHHHHH");
    }
}

class Orangutan extends Monkey
{
    private int swingPower;

    public Orangutan(){
        super("ORANGUTAN", 1);
        swingPower = 1;
    }

    public Orangutan(String name, int screech, int swing)
    {
        super(name, screech);
        swingPower = swing;
    }

    @Override
    public void speak(){
        System.out.println(super.getName() + " says Hello!");
    }

    @Override
    public String toString(){
        return super.getName() + " is a Orangutan with swing power of " + swingPower +
                " and screech power of " + super.getScreech();

    }

    public void swing(){
        System.out.println(super.getName() + " swings with a power of " + swingPower);
        System.out.println("SWINGGGGG");
    }
}
