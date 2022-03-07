using System.ComponentModel.DataAnnotations;
using Test.Models;

namespace test.Models {

    public class Booking {
        
        public int Id { get; set; }

        //Get Customer list
        [Display(Name = "Customers name")]
        public int CustomerId {get; set; }
        public Customer? Customer { get; set; }


        //Get Services list
        [Display(Name = "Customers name")]
        public int ServicesId {get; set; }
        public Services? Services { get; set; }


        //Timestamp
        [Display(Name = "Order date")]
        public DateTime OrderDate { get; set; } = DateTime.Now;


    }


}