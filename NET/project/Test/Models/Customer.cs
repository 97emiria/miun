using System.ComponentModel.DataAnnotations;

namespace Test.Models {


    public class Customer {

        public int Id { get; set; }

        //Name
        [Required(ErrorMessage = "Cannot be empty")]
        [Display(Name = "Customers name")]
        public string? Name { get; set; }

        //Phone
        [Required(ErrorMessage = "Cannot be empty")]
        public string? Phone { get; set; }

        //Timestamp
        [Display(Name = "Registered date")]
        public DateTime RegisteredDate { get; set; } = DateTime.Now;

    }

}