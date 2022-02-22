using System.ComponentModel.DataAnnotations;

namespace musicbank.Models
{
    public class Discs
    {
        //Properies

        public int id { get; set; }

        [Required(ErrorMessage = "Kan inte va tomt")]
        public string? Name { get; set; }

        [Required(ErrorMessage = "Kan inte va tomt")]
        public string? Artist { get; set; }

        [Display(Name = "Antal låtar:")]
        [Required(ErrorMessage = "Kan inte va tomt")]
        public int MumberOfSongs { get; set; }

        public bool Rented { get; set; } = false;
    }
}
