using System.ComponentModel.DataAnnotations;

namespace musicBank.Models
{
    public class Albums
    {
        public int id { get; set; }

        [Required(ErrorMessage = "Kan inte va tomt")]
        public string? Name { get; set; }

        [Required(ErrorMessage = "Kan inte va tomt")]
        public string? Artist { get; set; }

        [Display(Name = "Antal låtar:")]
        [Required(ErrorMessage = "Kan inte va tomt")]
        public int MumberOfSongs { get; set; }

        public bool Rented { get; set; } = false;


        public ICollection<Relation>? Relation { get; set; }
    }
}
