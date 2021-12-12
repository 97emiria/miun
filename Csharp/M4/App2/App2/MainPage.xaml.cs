using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Xamarin.Forms;

namespace App2
{
    public partial class MainPage : ContentPage
    {
        public MainPage()
        {
            InitializeComponent();
        }

        private void Button_Clicked(object sender, EventArgs e)
        {
            string message;
            string year = numEntry.Text;
            
            //Check vaild num
            string check = year.Substring(0, 2);

            //Get unique numbers
            string yy = year.Substring(0, 1);
            string ee = year.Substring(1, 1);
            string aa = year.Substring(2, 1);
            string rr = year.Substring(3, 1);

        
            //Arrays for rom nums
            string[] thousend = new string[] { "M", "MM" };
            string[] hundred = new string[] { "", "C", "CC", "CCC", "CD", "D", "DC", "DCC", "DCCC", "CM" };
            string[] ten = new string[] { "", "X", "XX", "XXX", "XL", "L", "LX", "LXX", "LXXX", "XC", "C" };
            string[] one = new string[] { "", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X" };


            if (check == "19" || check == "20")
            {
                message = thousend[Int32.Parse(yy) - 1] + "" + hundred[Int32.Parse(ee)] + "" + ten[Int32.Parse(aa)] + "" + one[Int32.Parse(rr)];
            }
            else
            {
                message = "Inte tillåtet årtal, måste börja med antingen 19 eller 20";

            }

            answeredLabel.Text = message;

        }
    }
}
