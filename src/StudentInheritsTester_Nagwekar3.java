public class StudentInheritsTester_Nagwekar3
{
    public static void main(String[] args)
    {
        Estudiante ansh = new Estudiante("Ansh", 65, 4.0, 221426);
        System.out.println(ansh.getStudentDescription());
    }

}

class Human
{
    private int height;
    private String name;

    public Human(int height, String name)
    {
        this.height = height;
        this.name = name;
    }

    public String getDescription(){
        return "Hi!, my name is " + name + " and I am " + height + " inches tall.";
    }
}

class Estudiante extends Human
{
    private double gpa;
    private int studentID;

    public Estudiante(String name, int height, double gpa, int studentID)
    {
        super(height, name);
        this.gpa = gpa;
        this.studentID = studentID;
    }

    public String getStudentDescription()
    {
        return super.getDescription() + "\nI have a " + gpa + " and my ID is " + studentID;
    }

}