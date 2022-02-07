using System.ComponentModel.DataAnnotations;

namespace momentet.Models {

    public class CourseModel {

        //Properties
        [Display(Name = "Kurskod:")]
        [Required(ErrorMessage = "Kan inte va tomt")]
        [MaxLength(6, ErrorMessage = "En kurskod innehåller max 6 tecken")]
        public string? Code { get; set; }

        [Display(Name = "Kursnamn:")]
        [Required(ErrorMessage = "Kan inte va tomt")]
        public string? Name { get; set; }

        [Display(Name = "Progression:")]
        [Required(ErrorMessage = "Kan inte va tomt")]
        [RegularExpression(@"^[A-B]+$", ErrorMessage = "Endast A eller B är tillgängliga")]
        [MaxLength(2, ErrorMessage = "Name length can't be more than 6.")]
        public string? Progression { get; set; }

        [Display(Name = "Kurslänk:")]
        [Required(ErrorMessage = "Kan inte va tomt")]
        public string? Url { get; set; }

    }


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