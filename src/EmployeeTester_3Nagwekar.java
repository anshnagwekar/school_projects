/**
    * Name: Ansh Nagwekar
    * Assignment: Inherits-A9: Book pgm
 */

/**
 * Tests out the Executive, Manager, and Employee class
 * @author: Ansh Nagwekar
 */
public class EmployeeTester_3Nagwekar {
    public static void main(String[] args) {
        Employee emp = new Employee("Ansh", 5);
        Employee man = new Manager("Bob", 10, "IT");
        Employee exec = new Executive("Jah", 15, "IT", "Data Organizing");

        System.out.println(emp + "\n");
        System.out.println(man + "\n");
        System.out.println(exec + "\n");
    }
}

class Employee
{
    private String name;
    private int salary;

    public Employee(String name, int salary) {
        this.name = name;
        this.salary = salary;
    }

    public String toString(){
        return name + " makes " + salary;
    }
}

class Manager extends Employee
{
    private String department;

    public Manager(String name, int salary, String department){
        super(name, salary);
        this.department = department;
    }

    @Override
    public String toString(){
        return super.toString() + "\nHe works in " + department;
    }
}

class Executive extends Manager
{
    private String project;

    public Executive(String name, int salary, String department, String project){
        super(name, salary, department);
        this.project = project;
    }

    @Override
    public String toString(){
        return super.toString() + "\nHe works on the project " + project;
    }
}