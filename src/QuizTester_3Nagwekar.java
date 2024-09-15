/**
 * Name: Ansh Nagwekar
 * Assignment: Inherits-A3: QuizMeas Bk
 */

/**
 * Tests Quiz and Data class
 * @author Ansh Nagwekar
 */
public class QuizTester_3Nagwekar
{

    /**
     * Executable that creates quiz objects and uses Data class methods.
     * @param args
     */
    public static void main(String[] args)
    {
        Quiz q1 = new Quiz(97);
        Quiz q2 = new Quiz(100);
        Quiz q3 = new Quiz(89.5);
        Quiz q4 = new Quiz(84.5);
        Quiz q5 = new Quiz(88);
        Quiz q6 = new Quiz(92);
        Quiz q7 = new Quiz(79.5);
        Quiz q8 = new Quiz(81);
        Quiz q9 = new Quiz(69.5);
        Quiz q10 = new Quiz(50);

        Measurable[] quizzes = {q1, q2, q3, q4, q5, q6, q7, q8, q9, q10};
        for(Measurable q : quizzes)
        {
            System.out.println(q + "\n");
        }
        Data quizCheck = new Data();
        System.out.println("Average Score: " + quizCheck.average(quizzes));
        System.out.println("\nMax: \n" + quizCheck.max(quizzes).toString());
    }

}

/**
 * Interface from book
 */
interface Measurable
{
    double getMeasure();
}

/**
 * Data class from book except for max method
 */
class Data
{

    /**
     Computes the average of the measures of the given objects.
     @param objects an array of Measurable objects
     @return the average of the measures
     */
    public static double average(Measurable[] objects)
    {
        double sum = 0;
        for (Measurable obj : objects)
        {
            sum=sum+obj.getMeasure();
        }
        if (objects.length > 0) { return sum / objects.length;}
        else { return 0; }
    }

    /**
     * E10.1 Book Problem
     * @param objects, array of Measurable objects
     * @return Measurable object with highest double value
     */
    public static Measurable max(Measurable[] objects)
    {
        Measurable m = objects[0];
        for(Measurable meas : objects)
        {
            if (meas.getMeasure() > m.getMeasure()) m = meas;
        }
        return m;
    }

}

/**
 * E10.2, Quiz class
 */
class Quiz implements Measurable
{
    private double grade;
    private String letterGrade;

    /**
     * Constructor that sets instance variable values.
     * @param grade, grade on quiz
     */
    public Quiz(double grade)
    {
        this.grade = grade;
        calculateLetterGrade(grade);
    }

    /**
     * @return interface method that returns quiz grade
     */
    public double getMeasure()
    {
        return grade;
    }

    /**
     * @return grade and letter grade
     */
    public String toString()
    {
        return "Grade: " + grade + "\nLetter Grade: " + letterGrade;
    }

    /**
     * Calculats Letter grade using Standard Grading
     * @param grade, the grade of quiz
     */
    private void calculateLetterGrade(double grade)
    {
        if(grade >= 97.5) letterGrade = "A+";
        else if (grade >= 92.5) letterGrade = "A";
        else if (grade >= 89.5) letterGrade = "A-";
        else if (grade >= 87.5) letterGrade = "B+";
        else if (grade >= 82.5) letterGrade = "B";
        else if (grade >= 79.5) letterGrade = "B-";
        else if (grade >= 77.5) letterGrade = "C+";
        else if (grade >= 72.5) letterGrade = "C";
        else if (grade >= 69.5) letterGrade = "C-";
        else if (grade >= 59.5) letterGrade = "D";
        else letterGrade = "F";
    }

}