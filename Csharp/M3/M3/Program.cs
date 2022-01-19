using System;
using System.Collections.Generic;
using System.IO;


namespace M3
{
    class Program
    {
        static void Main(string[] args)
        {
            /*Welcome to my guest book*/

            //Check if post file exist, if not, creat one
            if (checkFileExist())
            {
                //Loop thru menu function to right condition is accepted 
                bool menuStatus = true;
                while (menuStatus)
                {
                    bool showMenu = MainMenu();
                }

                //Menu fucntion
                static bool MainMenu()
                {
                    //Clear Console and add "header"
                    clearConsole();

                    //Print out menu options
                    Console.WriteLine("Choose an option:");
                    Console.WriteLine("1) See guestbook posts");
                    Console.WriteLine("2) Add post");
                    Console.WriteLine("3) Delete post");
                    Console.Write("\r\nSelect an option: ");

                    //Check what user print and run function thereafter
                    switch (Console.ReadLine())
                    {
                        case "1":
                            readPost();
                            return true;

                        case "2":
                            addPost();
                            return true;

                        case "3":
                            removePost();
                            return true;

                        default:
                            //Could have a message but naah, like it clean
                            return true;
                    }
                }

            }
        }


        private static bool clearConsole()
        {
            //Clear console
            Console.Clear();

            //Add Guestbook header (again)
            Console.WriteLine(" <-------- E M I L I A ' S   «---»   G U E S T B O O K --------> \n");

            return true;
        }

        //Use in the beginning of program to first check so a file exist and second to remove similar code in the program
        private static bool checkFileExist()
        {
            try
            {
                // Create an instance of StreamReader to read from a file.
                using (StreamReader sr = new StreamReader("../../../postList.txt"))
                return true;
            }
            catch (Exception)
            {
                //Let the user know what went wrong.
                Console.Write("The Guest Book dont exist, lets creat one and try again \n");

                using (FileStream fs = File.Create("../../../postList.txt"))

                Console.WriteLine("\nReturn to menu by clicking enter");
                Console.ReadLine();
                return true;
            }
        }


        private static bool addPost()
        {
            //Clear console
            clearConsole();

            //Check if post file exist again
            if (!checkFileExist())
            {
                return false;
            }

            string thePost = "";

            //Creat some needed values
            bool validatedUser = false;
            bool validatedPost = false;
            string user = "";
            string message = "";

            //Say hey to the class
            Posts newPost = new Posts(user, message);

            //If class not accept user name, make a infinity loop to it accepts
            while (!validatedUser)
            {
                //Collect value from user
                Console.Write("Your name: ");
                user = Console.ReadLine();

                newPost.User = user;

                if (newPost.User == "false")
                {
                    Console.WriteLine("The name its to short");
                }
                else
                {
                    validatedUser = true;
                }
            }


            //If class not accept post length, make a infinity loop to it accepts
            while (!validatedPost)
            {
                //Collect value from user
                Console.Write("What do you have to say?: ");
                message = Console.ReadLine();

                newPost.Message = message;

                if (newPost.Message == "false")
                {
                    Console.WriteLine("The post its to short");
                }
                else
                {
                    validatedPost = true;

                }
            }


            //Creat a string with name and message
            thePost = user + ": " + message;

            //Add to file, use append so its added and not overwrites
            using (StreamWriter sw = new StreamWriter("../../../postList.txt", append: true))
            {
                sw.WriteLine(thePost);
            }


            clearConsole();
            Console.WriteLine("Added to the list: \n" + thePost);
            Console.WriteLine("\nHead back to menu by clicking enter");
            Console.ReadLine();


            return true;
        }



        private static bool readPost()
        {

            //Clear console
            clearConsole();

            //Check if post file exist again
            if (!checkFileExist())
            {
                return false;
            }


            // Create an instance of StreamReader to read from a file.
            using (StreamReader sr = new StreamReader("../../../postList.txt"))
            {
                string line;
                int i = 1;

                // Read and display lines from the file until the end of the file is reached.
                while ((line = sr.ReadLine()) != null)
                {
                    Console.WriteLine("[" + i + "] " + line);
                    i++;
                }

                Console.WriteLine("\nReturn to menu by clicking enter");
            }


            Console.ReadLine();
            return true;
        }




        private static bool removePost()
        {
            //Clear console
            clearConsole();

            //Check if post file exist again (and creat one)
            if (!checkFileExist())
            {
                return false;
            }

            //Get messages/posts and convert text file to List<>
            List<String> postList = new List<String>();
            using (StreamReader sr = new StreamReader("../../../postList.txt"))
            {
                string line;
                int i = 1;
                while ((line = sr.ReadLine()) != null)
                {
                    //Put each text-line as own element i list
                    postList.Add(line);
                    i++;
                }
            }

            //For controlling id
            try
            {
                //Ask which post id to delete and save answerd
                Console.Write("So you want to delete a post? \nType in the post number: ");

                //Collect slected id and minus 1 to fit List<>-index
                int postID = Int32.Parse(Console.ReadLine()) - 1;

                //Clear console
                clearConsole();

                Console.WriteLine("Is this the right post?: \n" + postList[postID]);
                Console.Write("\nType 'y' for yes or just click enter (or anywhere except y) to return to main menu\n");

                switch (Console.ReadLine())
                {
                    //Rule one, always design the web for idiots
                    case "Y":
                    case "y":
                    case "yes":
                    case "Yes":
                    case "YES":
                    
                        //Remove that row from list-element
                        postList.RemoveAt(postID);

                        //Clear textfile
                        File.WriteAllText("../../../postList.txt", String.Empty);

                        //Take updated post list and add that to the now empty text-file
                        using (StreamWriter sw = new StreamWriter("../../../postList.txt", append: true))
                        {
                            foreach (string post in postList)
                            {
                                sw.WriteLine(post);
                            }
                        }

                        //Clear console
                        clearConsole();
                        Console.WriteLine("\nThe post is now deleted, return to menu by clicking enter");
                        Console.ReadLine();
                        return true;

                    default:
                        //Clear console
                        clearConsole();
                        Console.WriteLine("You will now be sent back to the main menu");//So user dont get stuck in removePost(), if they forgot id or something
                        Console.ReadLine();
                        return true;
                }
            } 
            //If user print in something els then numbers
            catch(FormatException e)
            {
                Console.Write(e.Message);
                Console.WriteLine("You will now be sent back to the main menu");//So user dont get stuck in removePost(), if they forgot id or something
                Console.ReadLine();
                return false;
            }
            //If user type in a number that dont exist in List<>
            catch(ArgumentOutOfRangeException)
            {
                Console.Write("Selected post dont exist, head back to guest book to see right number. ");
                Console.WriteLine("You will now be sent back to the main menu");//So user dont get stuck in removePost(), if they forgot id or something
                Console.ReadLine();
                return false;
            }

        }


    }
}
