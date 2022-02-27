using System.ComponentModel.DataAnnotations;

namespace musicBank.Models
{
    public class Borrower
    {
        public int BorrowerID { get; set; }

        [Required(ErrorMessage = "Kan inte va tomt")]
        [Display(Name = "Borrowers name")]
        public string? NameBorrower { get; set; }

        [Required(ErrorMessage = "Kan inte va tomt")]
        public string? Phone { get; set; }

        //Timestamp
        public DateTime RegisteredSince { get; set; } = DateTime.Now;

    }

}
