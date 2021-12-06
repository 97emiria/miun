using System;

namespace playhouse
{
    class Program
    {
        static void Main(string[] args)
        {


            Console.Write("Enter your first numb: ");
            int num1 = Convert.ToInt32(Console.ReadLine());
            Console.Write("Enter your second numb: ");
            int num2 = Convert.ToInt32(Console.ReadLine());

            //Console.WriteLine("Adding u num is " + num1+num2 + " minus would be" + num1-num2 + " and finally multi them would be" num1*num2);
            Console.WriteLine(num1 + " and " + num2);
        }

    }
    
}
