using System.ComponentModel.DataAnnotations;

namespace musicBank.Models
{
    public class Borrow
    {
        public int BorrowID { get; set; }


        //For album names
        public int AlbumID {get; set; }
        public Album? Album { get; set; }

        //Låntagare
        public int BorrowerID {get; set; }
        public Borrower? Borrower { get; set; }

        [Display(Name = "Rented")]
        public bool Rented { get; set; } = true;

        //Timestamp
        [Display(Name = "Time for rented")]
        public DateTime BorrowTime { get; set; } = DateTime.Now;

    }

}
