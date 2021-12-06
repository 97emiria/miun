using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace M3
{
    class Posts
    {
        private string user;
        private string message;


        public Posts(string theUser, string theMessage)
        {
            user = theUser;
            message = theMessage;
        }


        public string User
        {
            get { return user; }
            set
            {
                if (value.Length <= 1)
                {
                    user = "false";
                }
                else
                {
                    user = value;
                }
            }
        }


        public string Message
        {
            get { return message; }
            set
            {
                if(value.Length <= 1)
                {
                    message = "false";
                }
                else
                {
                    message = value;
                }
            }
        }



    }
}
