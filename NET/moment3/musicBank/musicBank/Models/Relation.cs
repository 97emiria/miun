using System.ComponentModel.DataAnnotations;

namespace musicBank.Models
{
    public class Relation
    {
        public int id { get; set; }

        public int AlbumID { get; set; }

        public int ArtistID { get; set; }

        //Modeller
        public Albums? Albums { get; set; }
        public Artists? Artists { get; set; }

    }
}
