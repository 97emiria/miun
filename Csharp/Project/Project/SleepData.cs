using System;
using System.Collections.Generic;
using System.IO;
using System.Text;
using System.Text.Json;
using System.Linq;
using Newtonsoft.Json;
using System.Drawing;
using Project;


namespace ConsoleApp2
{
    internal class SleepData
    {
        public int time { get; set; }
        public int grade { get; set; }
        public string note { get; set; }
        public DateTime timestamp { get; set; }

        
        //Call fileHandler class
        fileHandler fileHandler = new fileHandler();



        public void addData()
        {

            Console.WriteLine("     || Add sleep log\n\n");

            int hours = 0;
            int minutes = 0;
            int grade = 1;
            string note = "";
            Console.WriteLine("     Your sleep time in: \n");
            
            bool validatedHours = false;
            while (!validatedHours)
            {
                Console.Write("     Hours: ");

                hours = isItInt(Console.ReadLine());

                if (validateHours(hours) == true) validatedHours = true;
                if (validateHours(hours) == false) Console.WriteLine("     Its incorecct value, highest possible hours is 23, try again\n");

            }
            
            bool validatedMinutes = false;
            while (!validatedMinutes)
            {
                Console.Write("     Minutes: ");

                minutes = isItInt(Console.ReadLine());

                if (validateMinutes(minutes) == true) validatedMinutes = true;
                if (validateMinutes(minutes) == false) Console.WriteLine("     Its incorecct value, max 59, try again\n");

            }

            bool validatedGrades = false;
            while (!validatedGrades)
            {
                Console.Write("     Grade your sleep where 1 is bad and 5 is great: ");

                grade = isItInt(Console.ReadLine());

                if (validateGrade(grade) == true) validatedGrades = true; 
                if (validateGrade(grade) == false) Console.WriteLine("     Its incorecct value, only between number 1-5, try again\n");
            }

            bool validatedNotes = false;
            while (!validatedNotes)
            {
                Console.Write("     Note: ");
                note = Console.ReadLine();
                if (validateNote(note) == true) validatedNotes = true;
                if (validateNote(note) == false) Console.WriteLine("     Its incorecct value, max 50ch, try again\n");

            }

            Program.resetConsole();
            Console.WriteLine("     || Add sleep log\n\n");

            Console.WriteLine("     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
            Console.WriteLine("     Sleep time: " + hours + " h " + minutes + " minutes");
            Console.WriteLine("     Sleep grade: " + grade);
            Console.WriteLine("     Note: " + note);
            Console.WriteLine("     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");


            //Print out menu options
            Console.WriteLine("     How does it look?\n");
            Console.WriteLine("     " + Convert.ToChar(30) + " Upp   -  Its looks good\n");
            Console.WriteLine("     " + Convert.ToChar(16) + " Right -  Restart\n");
            Console.WriteLine("     " + Convert.ToChar(31) + " Down  -  Go back to main menu");

            switch (Console.ReadKey(false).Key)
            {
                case ConsoleKey.UpArrow:

                    Program.resetConsole();
                    Console.WriteLine("     || Add sleep log\n\n");

                    //Convert sleep time to only minutes
                    int time = (hours * 60) + minutes;

                    var newSleepData = new SleepData
                    {
                        time = time,
                        grade = grade,
                        note = note,
                        timestamp = DateTime.Now
                    };

                    string jsonString = System.Text.Json.JsonSerializer.Serialize(newSleepData);
                    fileHandler.add(jsonString);
                    
                    Console.WriteLine("     Data saved!");

                    getFullSleepData(1);
                    Program.returnMainMenu();

                    break;

                case ConsoleKey.RightArrow:
                    Program.resetConsole();
                    addData();
                    break;


                case ConsoleKey.DownArrow:
                    Program.returnMainMenu();
                    break;

                default:
                    break;

            }

          
            
        }



        public void getFullSleepData(int wantedDays)
        {


            List<string> sleepingDataList = fileHandler.getData();
            sleepingDataList.Reverse();


            for (int i = 0; i < wantedDays; i++)
            {
                SleepData line = JsonConvert.DeserializeObject<SleepData>(sleepingDataList[i]);

                Console.WriteLine("     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
                Console.WriteLine("     " + line.timestamp.ToLongDateString());
                Console.WriteLine("\n");
                Console.WriteLine("     Sleep time: " + convertTime(line.time));
                Console.WriteLine("     Sleep grade: " + line.grade);
                Console.WriteLine("     Note: " + line.note);
                Console.WriteLine("     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
                Console.WriteLine("\n");
            }

        }


        public string convertTime(double time)
        {
            //Calculation time
            double hours = Math.Floor(time / 60);
            double minutes = Math.Floor(( (time / 60) % 1) * 60);

            string resultMessage = hours + " hours and " + minutes + " minutes";

            return resultMessage;
        }



        public void getSleepSummery(int wantedDays)
        {
            //Get sleep data
            List<string> sleepingDataList = fileHandler.getData();
            sleepingDataList.Reverse();


            //Get sleep time
            double averageSleepTime;
            double minutes;
            double hours;
            double averageSleepGrade;
            double totalSleepTime;

            List<double> timeList = new List<double>();
            List<double> gradeList = new List<double>();
            List<DateTime> dateList = new List<DateTime>();


            for (int i = 0; i < wantedDays; i++)
            {
                SleepData sleepDataObject = JsonConvert.DeserializeObject<SleepData>(sleepingDataList[i]);
                timeList.Add(sleepDataObject.time);
                gradeList.Add(sleepDataObject.grade);
                dateList.Add(sleepDataObject.timestamp);
            }

            //Calculation time
            averageSleepTime = (timeList.Sum() / wantedDays) / 60;
            hours = Math.Floor(averageSleepTime);
            minutes = Math.Floor((averageSleepTime % 1) * 60);

            //Calculation average grade
            averageSleepGrade = Math.Floor(gradeList.Sum() / wantedDays);

            //Get higest sleep time
            double longestHours = Math.Floor(timeList.Max() / 60);
            double longestMinutes = Math.Floor(((timeList.Max() / 60) % 1) * 60);

            //Get lowest sleep time
            double lowHours = Math.Floor(timeList.Min() / 60);
            double lowMinutes = Math.Floor( ( (timeList.Min() / 60) % 1) * 60);

            //Get totalt sleep time
            totalSleepTime = timeList.Sum() / 60;
            double totalHours = Math.Floor(totalSleepTime);
            double totalMinutes = Math.Floor((totalSleepTime % 1) * 60);

            Console.WriteLine("     Your average sleep time the last " + wantedDays + " days have been " + hours + " hours och " + minutes + " minutes.");

            if(hours >= 7 && hours <= 9)
            {
                Console.WriteLine("     Your average sleep time the past days have been good for you!");
            }

            Console.WriteLine("     Also your average sleep grade during this time have been " + averageSleepGrade + ".");
            Console.WriteLine("\n");
            Console.WriteLine("     Your longest sleep was " + longestHours + " hours and " + longestMinutes + " minutes. ");
            Console.WriteLine("     Your shortest sleep was " + lowHours + " hours and " + lowMinutes + " minutes. ");
            Console.WriteLine("\n");
            Console.WriteLine("     In total have you slept " + totalHours + " hours and " + totalMinutes + " minutes for the last " + wantedDays + " days. ");


        }




        public void deleteData()
        {

            List<string> sleepingDataList = fileHandler.getData();

            int indexNum = 1;
            for (int i = 0; i < sleepingDataList.Count; i++)
            {
                SleepData sleepDataObject = JsonConvert.DeserializeObject<SleepData>(sleepingDataList[i]);
                Console.WriteLine("     [" + indexNum++ + "] " + sleepDataObject.timestamp.ToShortDateString());
            }
            
            Console.WriteLine("\n     So you want to delete a log?");
            Console.Write("     Type in the index number: ");
            int deleteIndex = Int32.Parse( Console.ReadLine() )-1;

            Program.resetConsole();
            Console.WriteLine("     || Delete Post \n\n");


            SleepData so = JsonConvert.DeserializeObject<SleepData>(sleepingDataList[deleteIndex]);
            Console.WriteLine("     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
            Console.WriteLine("     " +so.timestamp.ToLongDateString() +"\n");
            Console.WriteLine("     Sleep time: " + convertTime(so.time));
            Console.WriteLine("     Sleep grade: " + so.grade);
            Console.WriteLine("     Note: " + so.note);
            Console.WriteLine("     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");



            Console.WriteLine("\n\n     Is this the right post?\n");
            Console.WriteLine("     " + Convert.ToChar(30) + " Up    -  Yes, delete this one\n");
            Console.WriteLine("     " + Convert.ToChar(16) + " Right -  No, choose new one\n");
            Console.WriteLine("     " + Convert.ToChar(31) + " Down  -  Naah, changed my mind, back to main menu");

            //Check what user print and run function thereafter

            var ch = Console.ReadKey(false).Key;

            switch (ch)
            {
                case ConsoleKey.UpArrow:

                    //Reset console
                    Program.resetConsole();
                    Console.WriteLine("     || Delete Post \n\n");


                    sleepingDataList.RemoveAt(deleteIndex);
                    fileHandler.update(sleepingDataList);

                    Console.WriteLine("     Success! Log is now deleted");
                    Program.returnMainMenu();

                    break;

                case ConsoleKey.RightArrow:
                    Program.resetConsole();
                    Console.WriteLine("     || Delete sleep log \n\n");

                    deleteData();

                    break;



                case ConsoleKey.DownArrow:
                    Program.MainMenu();

                    break;


                default:
                    Console.WriteLine("Dosent work, try again\n");
                    Console.ReadLine();
                    break;


            }

        }

        public int isItInt(string value) 
        {
            int result;

            while (!Int32.TryParse(value, out result))
            {
                Console.WriteLine("     Not a valid number, try again.\n");
                Console.Write("     ");

                value = Console.ReadLine();
            }
            
            return result;
        }

        public bool validateHours(int value)
        {
            if (value > 23) return false;
            return true;
        }

        public bool validateMinutes(int value)
        {
            if (value > 59) return false;
            return true;
        }

        public bool validateGrade(int value)
        {
            if (value > 5 || value < 1) return false;
            return true;
        }

        public bool validateNote(string value)
        {
            if (value.Length > 50) return false;
            return true;
        }



    }


}