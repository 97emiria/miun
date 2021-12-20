using System;

namespace countDay
{
    class Program
    {
        static void Main(string[] args)
        {

            //theYear return a string so you can divide the centry and year
            string year = theYear();
            int c = Convert.ToInt32(year.Substring(0, 2));
            int y = Convert.ToInt32(year.Substring(2, 2));

            //This function already returning int
            int m = theMonth();
            int d = theDay();

           
            //Send them to function that calculate day
            string result = calculateDay(c, y, m, d);
            Console.WriteLine("The day you were born was a " + result);
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

                int num;
                bool test = Int32.TryParse(year, out num);

                //Check if input is only 4 charchters
                if (year.Length != 4)
                {
                    Console.WriteLine("The year need to be 4 numbers");
                }
                else if (!test)
                {
                    Console.WriteLine("Obviously it need to be numbers, try again!");
                }
                else
                {
                    //Everyyhing has went good so stop loop
                    validated = true;
                }



            }


            return year;

        }


        static int theMonth()
        {

            //Creat some needed values
            bool validated = false;
            string month = "";


            while (!validated)
            {
                //Collect value from user
                Console.Write("Type birth month: ");
                month = Console.ReadLine();


                if (month.Length <= 2 && month.Length >= 0)
                {

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

                }
                else
                {
                    Console.WriteLine("Only one or two characters is allow");
                }


            }


            int theMonth = Convert.ToInt32(month);

            return theMonth;
        }

        static int theDay()
        {

            //Creat some needed values
            bool validated = false;
            string day = "";


            while (!validated)
            {
                //Collect value from user
                Console.Write("Type birth day: ");
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
                        }
                        else
                        {
                            Console.WriteLine("Between 1 - 31");
                        }
                    }

                }
                else
                {
                    Console.WriteLine("Only one or two characters is allow");
                }


            }

            int theDay = Convert.ToInt32(day);
            return theDay;
        }


        public static string calculateDay(int c, int y, int m, int d)
        {

            //Needed to get correct data
            if (m < 3)
            {
                m += 12;
                y--;
            }

            //Formula to calculate day
            int answerd = (d + ((13 * (m + 1)) / 5) + y + (y / 4) + (c / 4) + 5 * c) % 7;

            //String to return
            string theDay = "";

            //Print out answerd depending on the answer from formula 
           switch (answerd)
            {
                case 1:

                    theDay = "Sunday";
                    return theDay;

                case 2:

                    theDay = "Monday";
                    return theDay;

                case 3:

                    theDay = "Tuesday";
                    return theDay;

                case 4:

                    theDay = "Wednesday";
                    return theDay;

                case 5:

                    theDay = "Thursday";
                    return theDay;

                case 6:

                    theDay = "Friday";
                    return theDay;

                case 7:

                    theDay = "Saturday";
                    return theDay;

            }
            /*
            string[] weekday = new string[7] { "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday" };
            theDay = weekday[answerd-1];
            */

            return theDay;
        }


    }
}