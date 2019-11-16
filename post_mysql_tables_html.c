#include <mysql/mysql.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <libintl.h>
#define MAXLEN 80
#define EXTRA 5
/* 4 for field name "data", 1 for "=" */
#define MAXINPUT MAXLEN+EXTRA+2
/* 1 for added line break, 1 for trailing NUL */
#define DATAFILE "./data.txt"
#ifdef ENABLE_NLS
#endif
char* concat(const char *s1, const char *s2){
    char *result = malloc(strlen(s1)+strlen(s2)+1);
    strcpy(result, s1);
    strcat(result, s2);
    return result;
}

char *gettable(char *datastring){

int lengthtblstr = strlen(datastring);
//printf("1a\n");
char *tablestr = (char*)malloc(30*sizeof(char));
//printf("2a\n");
int a = 0;
for(a=0;a<lengthtblstr;a++){
if(datastring[a]=='='){
//      printf("%s counter:%d charA:%c\n","inside -A- loop",a,datastring[a]);
                continue;
        }
        else if(datastring[a]=='&'){
//       printf("%s counter:%d charA:%c\n","inside -A- loop",a,datastring[a]);
                break;
        }
        else{
//       printf("%s counter:%d charA:%c\n","inside -A- loop",a,datastring[a]);
         tablestr[a-1]=datastring[a];
        }
}
return tablestr;
}

char *getdb(char *query){
int querylen = strlen(query);

int a =  0;
int tbllen=0;
for(a=0;a<querylen;a++){

        if(query[a]=='&'){
        break;
        }
        else{
        tbllen++;
        }
}

int c=tbllen+4;
char *dbstring = (char*)malloc(30*sizeof(char));
for(int b=c;b<querylen-1;b++){
        dbstring[b-c]=query[b];
}
return dbstring;

}

void unencode(char *src, char *last, char *dest){
 for(; src != last; src++, dest++)
   if(*src == '+')
     *dest = ' ';
   else if(*src == '%') {
     int code;
 if(sscanf(src+1, "%2x", &code) != 1) code = '?';
   *dest = code;
     src +=2;}
   else
     *dest = *src;
 *dest = '\n';
 *++dest = '\0';
}

void print_dashes (MYSQL_RES *res){

        MYSQL_FIELD *field;
        unsigned int i, j;

mysql_field_seek (res, 0);

//printf ("%c",'+');

for (i = 0; i < mysql_num_fields (res); i++){
        field = mysql_fetch_field (res);

        for (j = 0; j < field->max_length + 2; j++){
        }
//              printf ("%c",'-');
//      printf ("%c",'+');
        }
printf ("%c",'\n');
}

void process_result_set (MYSQL *conn, MYSQL_RES *res){

MYSQL_FIELD *field;
MYSQL_ROW row;
unsigned int i, col_len;

/* determine column display widths */

mysql_field_seek (res, 0);

for (i = 0; i < mysql_num_fields (res); i++){

        field = mysql_fetch_field (res);
        col_len = strlen (field->name);

        if (col_len < field->max_length)
col_len = field->max_length;

        if (col_len < 4 && !IS_NOT_NULL (field->flags))
                col_len = 4; /* 4 = length of the word “NULL” */

        field->max_length = col_len; /* reset column info */
}

//print_dashes (res);

//printf ("%c",'|');
//printf("Content-Type: text/html \n\n");
printf("<table>\n");
mysql_field_seek (res, 0);
printf("<tr>\n");

for (i = 0; i < mysql_num_fields (res); i++){
        field = mysql_fetch_field (res);
        printf ("<th> %-*s </th>\n", field->max_length, field->name);
}
printf("</tr>\n");

printf ("%c",'\n');

//print_dashes (res);

while ((row = mysql_fetch_row (res)) != NULL){

        mysql_field_seek (res, 0);
        //printf ("%c",'|');
  printf("<tr>\n");

for (i = 0; i < mysql_num_fields (res); i++){

                        field = mysql_fetch_field (res);

                        if (row[i] == NULL)
                                printf ("<td> %-*s </td>\n", field->max_length, "NULL");
                        else if (IS_NUM (field->type))
                        printf ("<td> %*s </td>\n", field->max_length, row[i]);
                        else
                        printf ("<td> %-*s </td>\n", field->max_length, row[i]);
                }
                        printf("</tr>\n");
                        printf ("%c",'\n');
        }
printf("</table>\n");

//print_dashes (res);
//printf ("%lu rows returned\n", (unsigned long) mysql_num_rows (res));
}

int main(void) {

static char *server = "localhost";
static char *user = "root";
static char *password = "ftgyhuji";
static unsigned int port = 3306;
static char *socket = NULL;
static unsigned int flags =0;
//static char *db = "school";

char *lenstr;
char input[MAXINPUT], data[MAXINPUT];
long len;
printf("Content-Type: text/html \n\n");
lenstr = getenv("CONTENT_LENGTH");
if(lenstr == NULL || sscanf(lenstr,"%ld",&len)!=1 || len > MAXLEN)
  printf("<P>Error in invocation - wrong FORM probably.");
else {
  FILE *f;
  fgets(input, len+1, stdin);
  unencode(input+EXTRA, input+len, data);
}
  /*f = fopen(DATAFILE, "a");
        if(f == NULL)
                printf("<P>Sorry, cannot store your data.");
        else{
fputs(data, f);
                fprintf(stderr,data);
        }
  fclose(f);
  printf("<P>Data has been stored.");
}*/

char *table = (char*)malloc(30*sizeof(char));
//static char *db; 
//= (char*)malloc(30*sizeof(char));

table = gettable(data);
char *db = getdb(data); 
char *query = concat("SELECT * FROM ", table);
/*
printf("1 :%s.\n",data);
printf("2 :%s.\n",table);
printf("3 :%s.\n",db);
printf("4 :%s.\n",query);
*/
MYSQL *conn;
MYSQL_RES *res;
MYSQL_ROW row;
conn = mysql_init(NULL);
if(!(mysql_real_connect(conn,server,user,password,db,port,socket,flags))){
printf("Error: cannot connect\n");
exit(1);
}

mysql_query(conn, query);

res = mysql_store_result(conn);
/*while(row=mysql_fetch_row(res)){
printf("%s\t%s\t%s\t%s\t%s\t%s\n",row[0],row[1],row[2],row[3],row[4],row[5]);
}*/
printf("<style>\n");
printf("body{\n");
printf("background-color:lightseagreen;\n");
printf("}\n");
printf("h1{\n");
printf("color:black;\n");
printf("text-align:center;\n");
printf("}\n");

printf("table {\n");

printf("border-collapse: collapse;\n");
    //printf("width: 100%;\n");
printf("}\n");

printf("th, td {\n");
    printf("text-align: left;\n");
    printf("padding: 8px;\n");
printf("}\n");

printf("tr{background-color: #f2f2f2}\n");

printf("th {\n");
    printf("background-color: #4CAF50;\n");
    printf("color: white;\n");
printf("}\n");
printf("ul {\n");
    printf("list-style-type: none;\n");
   printf("margin: 0;\n");
   printf("padding: 0;\n");
    printf("overflow: hidden;\n");
    printf("background-color: #333;\n");
printf("}\n");

printf("li {\n");
    printf("float: right;\n");
printf("}\n");

printf("li a {\n");
    printf("display: block;\n");
    printf("color: white;\n");
printf("text-align: center;\n");
    printf("padding: 14px 16px;\n");
    printf("text-decoration: none;\n");
printf("}\n");

printf("li a:hover:not(.active) {\n");
    printf("background-color: #111;\n");
printf("}\n");
printf(".active {\n");
    printf("background-color: #4CAF50;\n");
printf("}\n");
printf("</style>\n");
printf("<h1> MySQL Info Viewer</h1>\n");
printf("<ul>\n");
rintf("<li style=\"float:right\"><a href=\"/html/logoute.php\">Log out</a></li>");
printf("<li style=\"float:right\"><a href=\"/html/connecttablese.php\">Table Selection</a></li>\n");
printf("<li style=\"float:right\"><a href=\"/html/connectdatabasese.php\">Database Selection</a></ul>\n");
process_result_set(conn, res);
mysql_free_result(res);
mysql_close(conn);
/*
printf("<a href=\"/html/connecttablese.php\">Go back to table selection</a>");
printf("<br>\n");
printf("<a href=\"/html/logoute.php\">Log out</a>");
*/  
      return 0;
}
