using System.ComponentModel.DataAnnotations;

namespace momentet.ModelsTwo {

    public class GuestBookModel {

        //Properties
        [Display(Name = "Ditt namn:")]
        [Required(ErrorMessage = "Kan inte va tomt")]
        [MaxLength(6, ErrorMessage = "En kurskod innehåller max 6 tecken")]
        public string? Author { get; set; }

        [Display(Name = "Meddelande:")]
        [Required(ErrorMessage = "Kan inte va tomt")]
        [MaxLength(244, ErrorMessage = "En kurskod innehåller max 244 tecken")]
        public string? Message { get; set; }

        public string? Timestamp { get; set; }

    }

}