import java.util.ArrayList;

public class ListOfStudentsCompared_3Nagwekar {
    public static void main(String[] args){
        Student ansh = new Student(6.0, "ansh", 100);
        Student joel = new Student(2.0, "joel", 78);
        Student arnav = new Student(4.0, "arnav", 25);
        Student rijul = new Student(2.0, "rijul", 70);
        Student adrian = new Student(4.0, "adrian", 1);
        Student garrett = new Student(4.0, "garrett", 67);
        Student karthik = new Student(4.0, "karthik", 68);
        Student bryce = new Student(4.0, "bryce", 80);
        Student eric = new Student(4.0, "eric", 66);
        Student abhinav = new Student(4.0, "abhinav", 60);

        Student[] myClass = { ansh, abhinav, eric, arnav, rijul, garrett, karthik, bryce, adrian, joel };

        Student temp = myClass[0];
        int min = 0;
        for(int i = 0; i < myClass.length; i++){
            min = i;
            for(int j = i; j < myClass.length; j ++){
                if (myClass[min].compareTo(myClass[j]) >= 0) {
                    min = j;
                }
            }
            temp = myClass[i];
            myClass[i] = myClass[min];
            myClass[min] = temp;
        }

        for(Student c : myClass){
            System.out.println(c);
        }

    }
}

class Student implements Comparable
{
    private double gpa;
    private String name;
    private int height; //in inches

    public Student(double gpa, String name, int height){
        this.gpa = gpa;
        this.name = name;
        this.height = height;
    }

    public String toString(){
        return "Name: " + name + " GPA: " + gpa + " Height: " + height;
    }

    public int getHeight(){
        return height;
    }

    public double getGPA(){
        return gpa;
    }

    public String getName() { return name; }

    public int compareTo(Object other){
        Student thisStudent = (Student)other;

        int height1 = this.height;
        int height2 = thisStudent.getHeight();

        return height1 - height2;
    }
}

class Class
{
    private ArrayList<Student> ourClass = new ArrayList<Student>();

    public Class(ArrayList<Student> theClass){
        ourClass = theClass;
    }

    public void addStudent(Student s){
        ourClass.add(s);
    }

    public void organize(){
        Student temp = ourClass.get(0);
        int min = 0;
        for(int i = 0; i < ourClass.size(); i++){
            min = i;
            for(int j = i; j < ourClass.size(); j ++){
                if (ourClass.get(min).getName().compareTo(ourClass.get(j).getName()) >= 0) {
                    min = j;
                }
            }
            temp = ourClass.get(i);
            ourClass.set( i, ourClass.get(min));
            ourClass.set( min, temp);
        }
    }

    public Student findTallest(){
        Student s = ourClass.get(0);
        int index = 0;
        for(int i = 0; i < ourClass.size(); i ++){
            if (s.getHeight() < ourClass.get(i).getHeight()){
                index = i;
                s = ourClass.get(i);
            }
        }
        return ourClass.get(index);
    }

    public String toString(){
        String s = "";
        for(Student stud : ourClass){
            s += "\n" + stud;
        }
        return s;
    }


}


