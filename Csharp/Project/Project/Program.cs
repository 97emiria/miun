using System;
using System.IO;
using System.Collections.Generic;
using System.Linq;
using Project;
using System.Text.Json;
using Newtonsoft.Json;
using System.Globalization;
using System.Threading;
using System.Drawing;



namespace ConsoleApp2
{
    internal class Program
    {
        static void Main(string[] args)
        {
            //Check if file exist 
            fileHandler fh = new fileHandler();
            fh.fileExist();

            //Run menu which will start the program
            MainMenu();

        }

        //Clear Console and add Header
        public static void resetConsole()
        {
            Console.Clear();

            //Change Console Title
            Console.Title = "Sleep Log";

            //Change console language to english
            Thread.CurrentThread.CurrentCulture = new CultureInfo("en-US");

            //Change text color to blueish
            Console.ForegroundColor = ConsoleColor.Cyan;

            //Add header

            Console.WriteLine(@"

     ███████ ██      ███████ ███████ ██████      ██       ██████   ██████     
     ██      ██      ██      ██      ██   ██     ██      ██    ██ ██         
     ███████ ██      █████   █████   ██████      ██      ██    ██ ██   ███ 
          ██ ██      ██      ██      ██          ██      ██    ██ ██    ██ 
     ███████ ███████ ███████ ███████ ██          ███████  ██████   ██████ 
                                                                               
                                                                 ");

        }

        public static void returnMainMenu()
        {
            Console.WriteLine("\n");
            Console.WriteLine("     By clickning arrow down you will now be send back to Main menu");


            switch (Console.ReadKey().Key)
            {
                case ConsoleKey.DownArrow:
                    MainMenu();

                    break;

                default:
                    returnMainMenu();
                    break;

            }

        }

        //Menu fucntion
        public static void MainMenu()
        {
            resetConsole();

            //Get class
            SleepData sd = new SleepData();

            //Print out menu options
            Console.WriteLine("     || Main menu \n\n");

            Console.WriteLine("     Navigate throu menu with key arrows\n");
            Console.WriteLine("     " + Convert.ToChar(30) + " Up    -  See statistics\n");
            Console.WriteLine("     " + Convert.ToChar(16) + " Right -  Add sleep log\n");
            Console.WriteLine("     " + Convert.ToChar(17) + " Left  -  Delete sleep log\n");
            Console.WriteLine("     " + Convert.ToChar(31) + " Down  -  Exit");

            //Check what user print and run function thereafter

            switch (Console.ReadKey().Key)
            {
                case ConsoleKey.UpArrow:

                    statisticsMenu();

                    break;

                case ConsoleKey.RightArrow:
                    resetConsole(); 

                    sd.addData();

                    break;


                case ConsoleKey.LeftArrow:
                    resetConsole();
                    Console.WriteLine("     || Delete Post \n\n");
                    sd.deleteData();

                    returnMainMenu();

                    break;


                case ConsoleKey.DownArrow:
                    resetConsole();
                    Console.WriteLine("     Bye!");
                    Environment.Exit(0);

                    break;


                default:
                    MainMenu();
                    break;

            }

        }


        static void statisticsMenu()
        {
            SleepData sd = new SleepData();
            fileHandler fh = new fileHandler();


            //Clear Console and add explanatory header
            resetConsole();
            Console.WriteLine("     || Sleep statistics \n\n");

            if (fh.getCurrentDaySaved() == 0)
            {
                Console.WriteLine("     No data saved yet"); 
                returnMainMenu();
            }

            //Some variabler
            string usersWantedDays;
            int wantedDays = 0;
            bool validate = false;

            Console.WriteLine("     Navigate throu menu with arrows key\n");
            Console.WriteLine("     " + Convert.ToChar(30) + " Upp   -  Sleep summery\n");
            Console.WriteLine("     " + Convert.ToChar(16) + " Right -  Full sleep log\n");
            Console.WriteLine("     " + Convert.ToChar(31) + " Down  -  Back to main menu");
            
            //Check what user print and run function thereafter
            switch (Console.ReadKey(false).Key)
            {
                case ConsoleKey.RightArrow:
                    resetConsole();
                    Console.WriteLine("     || Sleep statistics > See full logs \n\n");


                    while (!validate)
                    {
                        Console.Write("     Choose number of days (available days " + fh.getCurrentDaySaved() + "): ");
                        usersWantedDays = Console.ReadLine();
                        wantedDays = Int32.Parse(usersWantedDays);

                        if (fh.getCurrentDaySaved() >= wantedDays) validate = true;
                        if (fh.getCurrentDaySaved() < wantedDays || wantedDays == 0) Console.WriteLine("     The number need to be between 1 - " + fh.getCurrentDaySaved() );
                    }

                    resetConsole();
                    Console.WriteLine("     || Sleep statistics > See full data \n\n");

                    sd.getFullSleepData(wantedDays);

                    returnMainMenu();

                    break;


                case ConsoleKey.UpArrow:
                    resetConsole();
                    Console.WriteLine("     || Sleep statistics > Summery \n\n");


                    while (!validate)
                    {
                        Console.Write("     Choose number of days (available days " + fh.getCurrentDaySaved() + "): ");
                        usersWantedDays = Console.ReadLine();
                        wantedDays = Int32.Parse(usersWantedDays);

                        if (fh.getCurrentDaySaved() >= wantedDays) validate = true;
                        if (fh.getCurrentDaySaved() < wantedDays || wantedDays == 0) Console.WriteLine("     The number need to be between 1 - " + fh.getCurrentDaySaved());
                    }


                    resetConsole();
                    Console.WriteLine("     || Sleep statistics > Summery \n\n");


                    sd.getSleepSummery(wantedDays);

                    returnMainMenu();

                    break;


                case ConsoleKey.DownArrow:
                    MainMenu();
                    break;


                default:
                    statisticsMenu();
                    break;

            }


        }


    }

}
