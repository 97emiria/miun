using System.ComponentModel.DataAnnotations;

namespace PlaylistApi.Models 
{
    public class Playlist {
        public int Id { get; set; }

        [Required]
        public string? Artist { get; set; }

        [Required]
        public string? Song { get; set; }

        [Required]
        public int Length { get; set; }

        [Required]
        public String? Category  { get; set; }
    }
}

