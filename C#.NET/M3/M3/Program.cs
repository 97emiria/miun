using System;
using System.Collections.Generic;

namespace M3
{
    class Program
    {
        static void Main(string[] args)
        {

            /*
                Posts postOne = new Posts("Emm", "This is my first posts");
                Posts postTwo = new Posts("Emm", "Another post test");
                Console.WriteLine(postTwo.post);
             */



            newPost();


        }



        static string newPost()
        {


            //Creat some needed values
            bool validatedUser = false;
            bool validatedPost = false;
            string user = "";
            string post = "";
            string timestamp = DateTime.Now.ToString("HH:mm d'/'M'/'y");

            //Say hey to class
            Posts newPost = new Posts(user, post, timestamp);

            //If class not accept user name, make a infinity loop to it accepts
            while (!validatedUser)
            {
                //Collect value from user
                Console.Write("Your name: ");
                user = Console.ReadLine();

                newPost.User = user;

                if (newPost.User == "false")
                {
                    Console.WriteLine("The username its to short");
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
                post = Console.ReadLine();

                newPost.Post = post;

                if (newPost.Post == "false")
                {
                    Console.WriteLine("The post its to short");
                }
                else
                {
                    validatedPost = true;

                }
            }


            //Return objeckt från klass != array


            newPost.User = user;
            newPost.Post = post;
            newPost.timestamp = timestamp;

            Console.WriteLine(newPost.User);

            return user;

        }


        static List<Posts> addPost()
        {

            //First, creat som data
           //string[] strArr = newPost();


            //Add post to list 
            List<Posts> postList = new List<Posts>();

 

            return postList;


        }


    }
}
