using System;

namespace countDay
{
    class Program
    {
        static void Main(string[] args)
        {
            //Convert.ToInt32

            //Get a validated year

          


            string year = theYear();
            string month = theMonth();
            string date = theDay();

            int c = Convert.ToInt32(year.Substring(0, 2));
            int y = Convert.ToInt32(year.Substring(2, 2));
            int m = Convert.ToInt32(month);
            int d = Convert.ToInt32(date);

            Console.WriteLine(c + " Bye " + y);


            //Formula to calculate day
            int day = (d + ((13 * (m + 1)) / 5) + y + (y / 4) + (c / 4) + 5 * c) % 7;

            //Sentence to use in answer below
            string sentence = "You was born on a ";

            //Print out answerd depending on the answer from formula 
            switch (day)
            {
                case 1:
                    Console.WriteLine(sentence + "Sunday");
                    break;
                case 2:
                    Console.WriteLine(sentence + "Monday");
                    break;
                case 3:
                    Console.WriteLine(sentence + "Tuesday");
                    break;
                case 4:
                    Console.WriteLine(sentence + "Wednesday");
                    break;
                case 5:
                    Console.WriteLine(sentence + "Thursday");
                    break;
                case 6:
                    Console.WriteLine(sentence + "Friday");
                    break;
                case 7:
                    Console.WriteLine(sentence + "Saturday");
                    break;
            }



        }


        static string theYear()
        {
            bool validated = false;
            string year = "";

            while (!validated)
            {
                //Collect value from user
                Console.Write("Type the year you was born: ");
                year = Console.ReadLine();


                //Check if input is only 4 charchters
                if (year.Length != 4)
                {
                    Console.WriteLine("The year need to be 4 numbers");
                }
                else
                {
                    int num;
                    bool test = Int32.TryParse(year, out num);

                    if (!test)
                    {
                        Console.WriteLine("Obviously it need to be numbers, try again!");
                    }
                    else
                    {
                        //Everyyhing has went good so stop loop
                        validated = true;

                    }

                }

            }

            return year;

        }


        static string theMonth()
        {

            //Creat some needed values
            bool validated = false;
            string month = "";


            while (!validated)
            {
                //Collect value from user
                Console.Write("Type birth month: ");
                month = Console.ReadLine();


                if (month.Length <= 2 && month.Length >= 0) {

                    int num;
                    bool test = Int32.TryParse(month, out num);

                    if (!test)
                    {
                        Console.WriteLine("Obviously it need to be numbers, try again!");
                    }
                    else
                    {
                        if (Convert.ToInt32(month) <= 12 && Convert.ToInt32(month) > 0)
                        {
                            //Everyyhing has went good so stop loop
                            validated = true;
                        }
                        else
                        {
                            Console.WriteLine("Between 1 - 12");
                        }
                    }

                } else
                {
                    Console.WriteLine("Only one or two char is allow");
                }


            }

            return month;
        }

        static string theDay()
        {

            //Creat some needed values
            bool validated = false;
            string day = "";


            while (!validated)
            {
                //Collect value from user
                Console.Write("Type birth month: ");
                day = Console.ReadLine();


                if (day.Length <= 2 && day.Length >= 0)
                {

                    int num;
                    bool test = Int32.TryParse(day, out num);

                    if (!test)
                    {
                        Console.WriteLine("Obviously it need to be numbers, try again!");
                    }
                    else
                    {
                       if (Convert.ToInt32(day) <= 31 && Convert.ToInt32(day) > 0)
                        {
                            //Everyyhing has went good so stop loop
                            validated = true;
                        } else
                        {
                            Console.WriteLine("Between 1 - 31");
                        }
                    }

                }
                else
                {
                    Console.WriteLine("Only one or two char is allow");
                }


            }

            return day;
        }


    }
}
