using System.ComponentModel.DataAnnotations;

namespace musicBank.Models
{
    public class Artist
    {
        //Properies
        public int ArtistID { get; set; }

        [Required(ErrorMessage = "Kan inte va tomt")]
        public string? ArtistName { get; set; }

        [Required(ErrorMessage = "Kan inte va tomt")]
        public string? Country { get; set; }

    }
}
