using System;
using System.Collections.Generic;
using System.IO;


namespace M3
{
    class Program
    {
        static void Main(string[] args)
        {

           
            bool menuStatus = true;
            while (menuStatus)
            {
                bool showMenu = MainMenu();
            }
            

            static bool MainMenu()
            {
                clearConsole();

                Console.WriteLine("Choose an option:");
                Console.WriteLine("1) See guestbook posts");
                Console.WriteLine("2) Add post");
                Console.WriteLine("3) Delete post");
                Console.Write("\r\nSelect an option: ");

                switch (Console.ReadLine())
                {
                    case "1":
                        readPost();
                        return true;

                    case "2":
                        addPost();
                        return true;

                    case "3":
                        removePostByID();
                        return true;

                    default:
                        return true;
                }
            }

        }


        private static bool clearConsole()
        {
            Console.Clear();
            Console.WriteLine(" <-------- E M I L I A ' S   «---»   G U E S T B O O K --------> ");
            Console.WriteLine("");

            return true;
        }


        private static bool addPost()
        {
            //Clear console
            clearConsole();

            string thePost = "";

            //Creat some needed values
            bool validatedUser = false;
            bool validatedPost = false;
            string user = "";
            string message = "";

            //Say hey to class
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


            //skapar en sträng som ska sparas i objekt listan
            thePost = user + ": " + message;



            //Add to file
            using (StreamWriter sw = new StreamWriter("postListExempel.txt", append: true))
            {
                sw.WriteLine(thePost);
            }


            clearConsole();
            Console.WriteLine("Added to the list: ");
            Console.WriteLine(thePost);
            Console.WriteLine("");
            Console.WriteLine("Head back to menu by clicking enter");
            Console.ReadLine();


            return true;
        }



        private static bool readPost()
        {

            //Clear console
            clearConsole();

            try
            {
                // Create an instance of StreamReader to read from a file.
                // The using statement also closes the StreamReader.
                using (StreamReader sr = new StreamReader("postListExempel.txt"))
                {
                    string line;
                    // Read and display lines from the file until the end of
                    // the file is reached.

                    int i = 1;
                    while ((line = sr.ReadLine()) != null)
                    {
                        Console.WriteLine("[" + i + "] " + line);
                        i++;
                    }
                }

                Console.WriteLine("");
                Console.WriteLine("Return to menu by clicking enter");

            }
            catch (Exception e)
            {
                // Let the user know what went wrong.
                Console.WriteLine("The file could not be read:");
                Console.WriteLine(e.Message);


                Console.WriteLine("");
                Console.WriteLine("Return to menu by clicking enter");
            }

            Console.ReadLine();
            return true;
        }




        private static bool removePostByID()
        {
            //Clear console
            clearConsole();

            //Ask which post id to delete and save answerd
            Console.WriteLine("So you want to delete a post?");
            Console.Write("Type in id: ");

            //Remove one to fit reality 
            int postID = Int32.Parse(Console.ReadLine())-1;

            //Convert text file to list to remove right element
            List<String> postList = new List<String>();
            using (StreamReader sr = new StreamReader("postListExempel.txt"))
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

            //Show which post have been deleted
            Console.WriteLine("");
            Console.WriteLine("This post is now deleted:");
            Console.WriteLine(postList[postID]);
            Console.Write("");

            //Remove that row from list-element
            postList.RemoveAt(postID);

            //Clear textfile
            File.WriteAllText("postListExempel.txt", String.Empty);

            //Take updated post list and add that to text-file
            using (StreamWriter sw = new StreamWriter("postListExempel.txt", append: true))
            {
                foreach (string post in postList)
                {
                    sw.WriteLine(post);
                }
            }

            Console.WriteLine("");
            Console.WriteLine("Return to menu by clicking enter");
            Console.ReadLine();


            return true;
        }






    }
}
