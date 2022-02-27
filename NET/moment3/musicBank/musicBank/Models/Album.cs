using System.ComponentModel.DataAnnotations;

namespace musicBank.Models
{
    public class Album
    {
        public int AlbumID { get; set; }

        [Required(ErrorMessage = "Kan inte va tomt")]
        public string? AlbumName { get; set; }

        [Required(ErrorMessage = "Kan inte va tomt")]

        public int ArtistID {get; set; }
        public Artist? Artist { get; set; }

    }
}
