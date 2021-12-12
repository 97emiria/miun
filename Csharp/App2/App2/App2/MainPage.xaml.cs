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
            //Get input numbers
            double l = Int32.Parse(lEntry.Text);
            double km = Int32.Parse(kmEntry.Text);

            //Ledning: 1 mile = 1.609 km, 1 gallon(US) = 3.785 liter.

            double gallon = Math.Round(l * 3.785);
            double mile = Math.Round(km * 1.609);

            string answerd = mile + "/" + gallon;

            string message = "Uträkngingen blev: \n" + answerd + " mpg";

            answeredLabel.Text = message;


        }

    }
}
