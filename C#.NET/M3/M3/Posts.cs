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
        private string post;
        public string timestamp { get; set; }


        public Posts(string theUser, string thePost, string theTimestamp)
        {
            user = theUser;
            post = thePost;
            timestamp = theTimestamp;
            
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


        public string Post
        {
            get { return post; }
            set
            {
                if(value.Length <= 1)
                {
                    post = "false";
                }
                else
                {
                    post = value;
                }
            }
        }


    }
}
