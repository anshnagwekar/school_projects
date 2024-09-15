import java.util.ArrayList;

public class StudentListTester_3Nagwekar {

    public static void main(String[] args){
        Student ansh = new Student(6.0, "ansh", 100);
        Student joel = new Student(2.0, "joel", 78);
        Student arnav = new Student(4.0, "arnav", 25);
        Student rijul = new Student(2.0, "rijul", 70);
        Student adrian = new Student(4.0, "adrian", 1);

        Class myClass = new Class(new ArrayList<Student>(5));
        myClass.addStudent(joel);
        myClass.addStudent(ansh);
        myClass.addStudent(arnav);
        myClass.addStudent(rijul);
        myClass.addStudent(adrian);

        System.out.println(myClass);
        System.out.println();
        System.out.println(myClass.findTallest());

    }
}

