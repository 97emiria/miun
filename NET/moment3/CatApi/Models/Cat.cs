using System.ComponentModel.DataAnnotations;

namespace CatApi.Models 
{
    public class Cat {
        public int Id { get; set; }

        [Required]
        public string? Name { get; set; }

        [Required]
        public string? Breed { get; set; }
        public bool IsAdopted { get; set; } = false;

        public DateTime Registerad { get; set; } = DateTime.Now;
    }
}

