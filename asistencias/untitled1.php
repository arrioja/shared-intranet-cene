 1   /*
    2    * Copyright 1996-2005 Sun Microsystems, Inc.  All Rights Reserved.
    3    * DO NOT ALTER OR REMOVE COPYRIGHT NOTICES OR THIS FILE HEADER.
    4    *
    5    * This code is free software; you can redistribute it and/or modify it
    6    * under the terms of the GNU General Public License version 2 only, as
    7    * published by the Free Software Foundation.  Sun designates this
    8    * particular file as subject to the "Classpath" exception as provided
    9    * by Sun in the LICENSE file that accompanied this code.
   10    *
   11    * This code is distributed in the hope that it will be useful, but WITHOUT
   12    * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
   13    * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License
   14    * version 2 for more details (a copy is included in the LICENSE file that
   15    * accompanied this code).
   16    *
   17    * You should have received a copy of the GNU General Public License version
   18    * 2 along with this work; if not, write to the Free Software Foundation,
   19    * Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA.
   20    *
   21    * Please contact Sun Microsystems, Inc., 4150 Network Circle, Santa Clara,
   22    * CA 95054 USA or visit www.sun.com if you need additional information or
   23    * have any questions.
   24    */
   25   
   26   /*
   27    * (C) Copyright Taligent, Inc. 1996 - All Rights Reserved
   28    * (C) Copyright IBM Corp. 1996-1998 - All Rights Reserved
   29    *
   30    *   The original version of this source code and documentation is copyrighted
   31    * and owned by Taligent, Inc., a wholly-owned subsidiary of IBM. These
   32    * materials are provided under terms of a License Agreement between Taligent
   33    * and Sun. This technology is protected by multiple US and International
   34    * patents. This notice and attribution to Taligent may not be removed.
   35    *   Taligent is a registered trademark of Taligent, Inc.
   36    *
   37    */
   38   
   39   package java.text;
   40   
   41   import java.io.IOException;
   42   import java.io.InvalidObjectException;
   43   import java.io.ObjectInputStream;
   44   import java.util.Calendar;
   45   import java.util.Date;
   46   import java.util.GregorianCalendar;
   47   import java.util.Hashtable;
   48   import java.util.Locale;
   49   import java.util.Map;
   50   import java.util.MissingResourceException;
   51   import java.util.ResourceBundle;
   52   import java.util.SimpleTimeZone;
   53   import java.util.TimeZone;
   54   import sun.util.calendar.CalendarUtils;
   55   import sun.util.calendar.ZoneInfoFile;
   56   import sun.util.resources.LocaleData;
   57   
   58   /**
   59    * <code>SimpleDateFormat</code> is a concrete class for formatting and
   60    * parsing dates in a locale-sensitive manner. It allows for formatting
   61    * (date -> text), parsing (text -> date), and normalization.
   62    *
   63    * <p>
   64    * <code>SimpleDateFormat</code> allows you to start by choosing
   65    * any user-defined patterns for date-time formatting. However, you
   66    * are encouraged to create a date-time formatter with either
   67    * <code>getTimeInstance</code>, <code>getDateInstance</code>, or
   68    * <code>getDateTimeInstance</code> in <code>DateFormat</code>. Each
   69    * of these class methods can return a date/time formatter initialized
   70    * with a default format pattern. You may modify the format pattern
   71    * using the <code>applyPattern</code> methods as desired.
   72    * For more information on using these methods, see
   73    * {@link DateFormat}.
   74    *
   75    * <h4>Date and Time Patterns</h4>
   76    * <p>
   77    * Date and time formats are specified by <em>date and time pattern</em>
   78    * strings.
   79    * Within date and time pattern strings, unquoted letters from
   80    * <code>'A'</code> to <code>'Z'</code> and from <code>'a'</code> to
   81    * <code>'z'</code> are interpreted as pattern letters representing the
   82    * components of a date or time string.
   83    * Text can be quoted using single quotes (<code>'</code>) to avoid
   84    * interpretation.
   85    * <code>"''"</code> represents a single quote.
   86    * All other characters are not interpreted; they're simply copied into the
   87    * output string during formatting or matched against the input string
   88    * during parsing.
   89    * <p>
   90    * The following pattern letters are defined (all other characters from
   91    * <code>'A'</code> to <code>'Z'</code> and from <code>'a'</code> to
   92    * <code>'z'</code> are reserved):
   93    * <blockquote>
   94    * <table border=0 cellspacing=3 cellpadding=0 summary="Chart shows pattern letters, date/time component, presentation, and examples.">
   95    *     <tr bgcolor="#ccccff">
   96    *         <th align=left>Letter
   97    *         <th align=left>Date or Time Component
   98    *         <th align=left>Presentation
   99    *         <th align=left>Examples
  100    *     <tr>
  101    *         <td><code>G</code>
  102    *         <td>Era designator
  103    *         <td><a href="#text">Text</a>
  104    *         <td><code>AD</code>
  105    *     <tr bgcolor="#eeeeff">
  106    *         <td><code>y</code>
  107    *         <td>Year
  108    *         <td><a href="#year">Year</a>
  109    *         <td><code>1996</code>; <code>96</code>
  110    *     <tr>
  111    *         <td><code>M</code>
  112    *         <td>Month in year
  113    *         <td><a href="#month">Month</a>
  114    *         <td><code>July</code>; <code>Jul</code>; <code>07</code>
  115    *     <tr bgcolor="#eeeeff">
  116    *         <td><code>w</code>
  117    *         <td>Week in year
  118    *         <td><a href="#number">Number</a>
  119    *         <td><code>27</code>
  120    *     <tr>
  121    *         <td><code>W</code>
  122    *         <td>Week in month
  123    *         <td><a href="#number">Number</a>
  124    *         <td><code>2</code>
  125    *     <tr bgcolor="#eeeeff">
  126    *         <td><code>D</code>
  127    *         <td>Day in year
  128    *         <td><a href="#number">Number</a>
  129    *         <td><code>189</code>
  130    *     <tr>
  131    *         <td><code>d</code>
  132    *         <td>Day in month
  133    *         <td><a href="#number">Number</a>
  134    *         <td><code>10</code>
  135    *     <tr bgcolor="#eeeeff">
  136    *         <td><code>F</code>
  137    *         <td>Day of week in month
  138    *         <td><a href="#number">Number</a>
  139    *         <td><code>2</code>
  140    *     <tr>
  141    *         <td><code>E</code>
  142    *         <td>Day in week
  143    *         <td><a href="#text">Text</a>
  144    *         <td><code>Tuesday</code>; <code>Tue</code>
  145    *     <tr bgcolor="#eeeeff">
  146    *         <td><code>a</code>
  147    *         <td>Am/pm marker
  148    *         <td><a href="#text">Text</a>
  149    *         <td><code>PM</code>
  150    *     <tr>
  151    *         <td><code>H</code>
  152    *         <td>Hour in day (0-23)
  153    *         <td><a href="#number">Number</a>
  154    *         <td><code>0</code>
  155    *     <tr bgcolor="#eeeeff">
  156    *         <td><code>k</code>
  157    *         <td>Hour in day (1-24)
  158    *         <td><a href="#number">Number</a>
  159    *         <td><code>24</code>
  160    *     <tr>
  161    *         <td><code>K</code>
  162    *         <td>Hour in am/pm (0-11)
  163    *         <td><a href="#number">Number</a>
  164    *         <td><code>0</code>
  165    *     <tr bgcolor="#eeeeff">
  166    *         <td><code>h</code>
  167    *         <td>Hour in am/pm (1-12)
  168    *         <td><a href="#number">Number</a>
  169    *         <td><code>12</code>
  170    *     <tr>
  171    *         <td><code>m</code>
  172    *         <td>Minute in hour
  173    *         <td><a href="#number">Number</a>
  174    *         <td><code>30</code>
  175    *     <tr bgcolor="#eeeeff">
  176    *         <td><code>s</code>
  177    *         <td>Second in minute
  178    *         <td><a href="#number">Number</a>
  179    *         <td><code>55</code>
  180    *     <tr>
  181    *         <td><code>S</code>
  182    *         <td>Millisecond
  183    *         <td><a href="#number">Number</a>
  184    *         <td><code>978</code>
  185    *     <tr bgcolor="#eeeeff">
  186    *         <td><code>z</code>
  187    *         <td>Time zone
  188    *         <td><a href="#timezone">General time zone</a>
  189    *         <td><code>Pacific Standard Time</code>; <code>PST</code>; <code>GMT-08:00</code>
  190    *     <tr>
  191    *         <td><code>Z</code>
  192    *         <td>Time zone
  193    *         <td><a href="#rfc822timezone">RFC 822 time zone</a>
  194    *         <td><code>-0800</code>
  195    * </table>
  196    * </blockquote>
  197    * Pattern letters are usually repeated, as their number determines the
  198    * exact presentation:
  199    * <ul>
  200    * <li><strong><a name="text">Text:</a></strong>
  201    *     For formatting, if the number of pattern letters is 4 or more,
  202    *     the full form is used; otherwise a short or abbreviated form
  203    *     is used if available.
  204    *     For parsing, both forms are accepted, independent of the number
  205    *     of pattern letters.
  206    * <li><strong><a name="number">Number:</a></strong>
  207    *     For formatting, the number of pattern letters is the minimum
  208    *     number of digits, and shorter numbers are zero-padded to this amount.
  209    *     For parsing, the number of pattern letters is ignored unless
  210    *     it's needed to separate two adjacent fields.
  211    * <li><strong><a name="year">Year:</a></strong>
  212    *     If the formatter's {@link #getCalendar() Calendar} is the Gregorian
  213    *     calendar, the following rules are applied.<br>
  214    *     <ul>
  215    *     <li>For formatting, if the number of pattern letters is 2, the year
  216    *         is truncated to 2 digits; otherwise it is interpreted as a
  217    *         <a href="#number">number</a>.
  218    *     <li>For parsing, if the number of pattern letters is more than 2,
  219    *         the year is interpreted literally, regardless of the number of
  220    *         digits. So using the pattern "MM/dd/yyyy", "01/11/12" parses to
  221    *         Jan 11, 12 A.D.
  222    *     <li>For parsing with the abbreviated year pattern ("y" or "yy"),
  223    *         <code>SimpleDateFormat</code> must interpret the abbreviated year
  224    *         relative to some century.  It does this by adjusting dates to be
  225    *         within 80 years before and 20 years after the time the <code>SimpleDateFormat</code>
  226    *         instance is created. For example, using a pattern of "MM/dd/yy" and a
  227    *         <code>SimpleDateFormat</code> instance created on Jan 1, 1997,  the string
  228    *         "01/11/12" would be interpreted as Jan 11, 2012 while the string "05/04/64"
  229    *         would be interpreted as May 4, 1964.
  230    *         During parsing, only strings consisting of exactly two digits, as defined by
  231    *         {@link Character#isDigit(char)}, will be parsed into the default century.
  232    *         Any other numeric string, such as a one digit string, a three or more digit
  233    *         string, or a two digit string that isn't all digits (for example, "-1"), is
  234    *         interpreted literally.  So "01/02/3" or "01/02/003" are parsed, using the
  235    *         same pattern, as Jan 2, 3 AD.  Likewise, "01/02/-3" is parsed as Jan 2, 4 BC.
  236    *     </ul>
  237    *     Otherwise, calendar system specific forms are applied.
  238    *     For both formatting and parsing, if the number of pattern
  239    *     letters is 4 or more, a calendar specific {@linkplain
  240    *     Calendar#LONG long form} is used. Otherwise, a calendar
  241    *     specific {@linkplain Calendar#SHORT short or abbreviated form}
  242    *     is used.
  243    * <li><strong><a name="month">Month:</a></strong>
  244    *     If the number of pattern letters is 3 or more, the month is
  245    *     interpreted as <a href="#text">text</a>; otherwise,
  246    *     it is interpreted as a <a href="#number">number</a>.
  247    * <li><strong><a name="timezone">General time zone:</a></strong>
  248    *     Time zones are interpreted as <a href="#text">text</a> if they have
  249    *     names. For time zones representing a GMT offset value, the
  250    *     following syntax is used:
  251    *     <pre>
  252    *     <a name="GMTOffsetTimeZone"><i>GMTOffsetTimeZone:</i></a>
  253    *             <code>GMT</code> <i>Sign</i> <i>Hours</i> <code>:</code> <i>Minutes</i>
  254    *     <i>Sign:</i> one of
  255    *             <code>+ -</code>
  256    *     <i>Hours:</i>
  257    *             <i>Digit</i>
  258    *             <i>Digit</i> <i>Digit</i>
  259    *     <i>Minutes:</i>
  260    *             <i>Digit</i> <i>Digit</i>
  261    *     <i>Digit:</i> one of
  262    *             <code>0 1 2 3 4 5 6 7 8 9</code></pre>
  263    *     <i>Hours</i> must be between 0 and 23, and <i>Minutes</i> must be between
  264    *     00 and 59. The format is locale independent and digits must be taken
  265    *     from the Basic Latin block of the Unicode standard.
  266    *     <p>For parsing, <a href="#rfc822timezone">RFC 822 time zones</a> are also
  267    *     accepted.
  268    * <li><strong><a name="rfc822timezone">RFC 822 time zone:</a></strong>
  269    *     For formatting, the RFC 822 4-digit time zone format is used:
  270    *     <pre>
  271    *     <i>RFC822TimeZone:</i>
  272    *             <i>Sign</i> <i>TwoDigitHours</i> <i>Minutes</i>
  273    *     <i>TwoDigitHours:</i>
  274    *             <i>Digit Digit</i></pre>
  275    *     <i>TwoDigitHours</i> must be between 00 and 23. Other definitions
  276    *     are as for <a href="#timezone">general time zones</a>.
  277    *     <p>For parsing, <a href="#timezone">general time zones</a> are also
  278    *     accepted.
  279    * </ul>
  280    * <code>SimpleDateFormat</code> also supports <em>localized date and time
  281    * pattern</em> strings. In these strings, the pattern letters described above
  282    * may be replaced with other, locale dependent, pattern letters.
  283    * <code>SimpleDateFormat</code> does not deal with the localization of text
  284    * other than the pattern letters; that's up to the client of the class.
  285    * <p>
  286    *
  287    * <h4>Examples</h4>
  288    *
  289    * The following examples show how date and time patterns are interpreted in
  290    * the U.S. locale. The given date and time are 2001-07-04 12:08:56 local time
  291    * in the U.S. Pacific Time time zone.
  292    * <blockquote>
  293    * <table border=0 cellspacing=3 cellpadding=0 summary="Examples of date and time patterns interpreted in the U.S. locale">
  294    *     <tr bgcolor="#ccccff">
  295    *         <th align=left>Date and Time Pattern
  296    *         <th align=left>Result
  297    *     <tr>
  298    *         <td><code>"yyyy.MM.dd G 'at' HH:mm:ss z"</code>
  299    *         <td><code>2001.07.04 AD at 12:08:56 PDT</code>
  300    *     <tr bgcolor="#eeeeff">
  301    *         <td><code>"EEE, MMM d, ''yy"</code>
  302    *         <td><code>Wed, Jul 4, '01</code>
  303    *     <tr>
  304    *         <td><code>"h:mm a"</code>
  305    *         <td><code>12:08 PM</code>
  306    *     <tr bgcolor="#eeeeff">
  307    *         <td><code>"hh 'o''clock' a, zzzz"</code>
  308    *         <td><code>12 o'clock PM, Pacific Daylight Time</code>
  309    *     <tr>
  310    *         <td><code>"K:mm a, z"</code>
  311    *         <td><code>0:08 PM, PDT</code>
  312    *     <tr bgcolor="#eeeeff">
  313    *         <td><code>"yyyyy.MMMMM.dd GGG hh:mm aaa"</code>
  314    *         <td><code>02001.July.04 AD 12:08 PM</code>
  315    *     <tr>
  316    *         <td><code>"EEE, d MMM yyyy HH:mm:ss Z"</code>
  317    *         <td><code>Wed, 4 Jul 2001 12:08:56 -0700</code>
  318    *     <tr bgcolor="#eeeeff">
  319    *         <td><code>"yyMMddHHmmssZ"</code>
  320    *         <td><code>010704120856-0700</code>
  321    *     <tr>
  322    *         <td><code>"yyyy-MM-dd'T'HH:mm:ss.SSSZ"</code>
  323    *         <td><code>2001-07-04T12:08:56.235-0700</code>
  324    * </table>
  325    * </blockquote>
  326    *
  327    * <h4><a name="synchronization">Synchronization</a></h4>
  328    *
  329    * <p>
  330    * Date formats are not synchronized.
  331    * It is recommended to create separate format instances for each thread.
  332    * If multiple threads access a format concurrently, it must be synchronized
  333    * externally.
  334    *
  335    * @see          <a href="http://java.sun.com/docs/books/tutorial/i18n/format/simpleDateFormat.html">Java Tutorial</a>
  336    * @see          java.util.Calendar
  337    * @see          java.util.TimeZone
  338    * @see          DateFormat
  339    * @see          DateFormatSymbols
  340    * @author       Mark Davis, Chen-Lieh Huang, Alan Liu
  341    */
  342   public class SimpleDateFormat extends DateFormat {
  343   
  344       // the official serial version ID which says cryptically
  345       // which version we're compatible with
  346       static final long serialVersionUID = 4774881970558875024L;
  347   
  348       // the internal serial version which says which version was written
  349       // - 0 (default) for version up to JDK 1.1.3
  350       // - 1 for version from JDK 1.1.4, which includes a new field
  351       static final int currentSerialVersion = 1;
  352   
  353       /**
  354        * The version of the serialized data on the stream.  Possible values:
  355        * <ul>
  356        * <li><b>0</b> or not present on stream: JDK 1.1.3.  This version
  357        * has no <code>defaultCenturyStart</code> on stream.
  358        * <li><b>1</b> JDK 1.1.4 or later.  This version adds
  359        * <code>defaultCenturyStart</code>.
  360        * </ul>
  361        * When streaming out this class, the most recent format
  362        * and the highest allowable <code>serialVersionOnStream</code>
  363        * is written.
  364        * @serial
  365        * @since JDK1.1.4
  366        */
  367       private int serialVersionOnStream = currentSerialVersion;
  368   
  369       /**
  370        * The pattern string of this formatter.  This is always a non-localized
  371        * pattern.  May not be null.  See class documentation for details.
  372        * @serial
  373        */
  374       private String pattern;
  375   
  376       /**
  377        * The compiled pattern.
  378        */
  379       transient private char[] compiledPattern;
  380   
  381       /**
  382        * Tags for the compiled pattern.
  383        */
  384       private final static int TAG_QUOTE_ASCII_CHAR       = 100;
  385       private final static int TAG_QUOTE_CHARS            = 101;
  386   
  387       /**
  388        * Locale dependent digit zero.
  389        * @see #zeroPaddingNumber
  390        * @see java.text.DecimalFormatSymbols#getZeroDigit
  391        */
  392       transient private char zeroDigit;
  393   
  394       /**
  395        * The symbols used by this formatter for week names, month names,
  396        * etc.  May not be null.
  397        * @serial
  398        * @see java.text.DateFormatSymbols
  399        */
  400       private DateFormatSymbols formatData;
  401   
  402       /**
  403        * We map dates with two-digit years into the century starting at
  404        * <code>defaultCenturyStart</code>, which may be any date.  May
  405        * not be null.
  406        * @serial
  407        * @since JDK1.1.4
  408        */
  409       private Date defaultCenturyStart;
  410   
  411       transient private int defaultCenturyStartYear;
  412   
  413       private static final int MILLIS_PER_MINUTE = 60 * 1000;
  414   
  415       // For time zones that have no names, use strings GMT+minutes and
  416       // GMT-minutes. For instance, in France the time zone is GMT+60.
  417       private static final String GMT = "GMT";
  418   
  419       /**
  420        * Cache to hold the DateTimePatterns of a Locale.
  421        */
  422       private static Hashtable<String,String[]> cachedLocaleData
  423           = new Hashtable<String,String[]>(3);
  424   
  425       /**
  426        * Cache NumberFormat instances with Locale key.
  427        */
  428       private static Hashtable<Locale,NumberFormat> cachedNumberFormatData
  429           = new Hashtable<Locale,NumberFormat>(3);
  430   
  431       /**
  432        * The Locale used to instantiate this
  433        * <code>SimpleDateFormat</code>. The value may be null if this object
  434        * has been created by an older <code>SimpleDateFormat</code> and
  435        * deserialized.
  436        *
  437        * @serial
  438        * @since 1.6
  439        */
  440       private Locale locale;
  441   
  442       /**
  443        * Indicates whether this <code>SimpleDateFormat</code> should use
  444        * the DateFormatSymbols. If true, the format and parse methods
  445        * use the DateFormatSymbols values. If false, the format and
  446        * parse methods call Calendar.getDisplayName or
  447        * Calendar.getDisplayNames.
  448        */
  449       transient boolean useDateFormatSymbols;
  450   
  451       /**
  452        * Constructs a <code>SimpleDateFormat</code> using the default pattern and
  453        * date format symbols for the default locale.
  454        * <b>Note:</b> This constructor may not support all locales.
  455        * For full coverage, use the factory methods in the {@link DateFormat}
  456        * class.
  457        */
  458       public SimpleDateFormat() {
  459           this(SHORT, SHORT, Locale.getDefault());
  460       }
  461   
  462       /**
  463        * Constructs a <code>SimpleDateFormat</code> using the given pattern and
  464        * the default date format symbols for the default locale.
  465        * <b>Note:</b> This constructor may not support all locales.
  466        * For full coverage, use the factory methods in the {@link DateFormat}
  467        * class.
  468        *
  469        * @param pattern the pattern describing the date and time format
  470        * @exception NullPointerException if the given pattern is null
  471        * @exception IllegalArgumentException if the given pattern is invalid
  472        */
  473       public SimpleDateFormat(String pattern)
  474       {
  475           this(pattern, Locale.getDefault());
  476       }
  477   
  478       /**
  479        * Constructs a <code>SimpleDateFormat</code> using the given pattern and
  480        * the default date format symbols for the given locale.
  481        * <b>Note:</b> This constructor may not support all locales.
  482        * For full coverage, use the factory methods in the {@link DateFormat}
  483        * class.
  484        *
  485        * @param pattern the pattern describing the date and time format
  486        * @param locale the locale whose date format symbols should be used
  487        * @exception NullPointerException if the given pattern or locale is null
  488        * @exception IllegalArgumentException if the given pattern is invalid
  489        */
  490       public SimpleDateFormat(String pattern, Locale locale)
  491       {
  492           if (pattern == null || locale == null) {
  493               throw new NullPointerException();
  494           }
  495   
  496           initializeCalendar(locale);
  497           this.pattern = pattern;
  498           this.formatData = DateFormatSymbols.getInstance(locale);
  499           this.locale = locale;
  500           initialize(locale);
  501       }
  502   
  503       /**
  504        * Constructs a <code>SimpleDateFormat</code> using the given pattern and
  505        * date format symbols.
  506        *
  507        * @param pattern the pattern describing the date and time format
  508        * @param formatSymbols the date format symbols to be used for formatting
  509        * @exception NullPointerException if the given pattern or formatSymbols is null
  510        * @exception IllegalArgumentException if the given pattern is invalid
  511        */
  512       public SimpleDateFormat(String pattern, DateFormatSymbols formatSymbols)
  513       {
  514           if (pattern == null || formatSymbols == null) {
  515               throw new NullPointerException();
  516           }
  517   
  518           this.pattern = pattern;
  519           this.formatData = (DateFormatSymbols) formatSymbols.clone();
  520           this.locale = Locale.getDefault();
  521           initializeCalendar(this.locale);
  522           initialize(this.locale);
  523           useDateFormatSymbols = true;
  524       }
  525   
  526       /* Package-private, called by DateFormat factory methods */
  527       SimpleDateFormat(int timeStyle, int dateStyle, Locale loc) {
  528           if (loc == null) {
  529               throw new NullPointerException();
  530           }
  531   
  532           this.locale = loc;
  533           // initialize calendar and related fields
  534           initializeCalendar(loc);
  535   
  536           /* try the cache first */
  537           String key = getKey();
  538           String[] dateTimePatterns = cachedLocaleData.get(key);
  539           if (dateTimePatterns == null) { /* cache miss */
  540               ResourceBundle r = LocaleData.getDateFormatData(loc);
  541               if (!isGregorianCalendar()) {
  542                   try {
  543                       dateTimePatterns = r.getStringArray(getCalendarName() + ".DateTimePatterns");
  544                   } catch (MissingResourceException e) {
  545                   }
  546               }
  547               if (dateTimePatterns == null) {
  548                   dateTimePatterns = r.getStringArray("DateTimePatterns");
  549               }
  550               /* update cache */
  551               cachedLocaleData.put(key, dateTimePatterns);
  552           }
  553           formatData = DateFormatSymbols.getInstance(loc);
  554           if ((timeStyle >= 0) && (dateStyle >= 0)) {
  555               Object[] dateTimeArgs = {dateTimePatterns[timeStyle],
  556                                        dateTimePatterns[dateStyle + 4]};
  557               pattern = MessageFormat.format(dateTimePatterns[8], dateTimeArgs);
  558           }
  559           else if (timeStyle >= 0) {
  560               pattern = dateTimePatterns[timeStyle];
  561           }
  562           else if (dateStyle >= 0) {
  563               pattern = dateTimePatterns[dateStyle + 4];
  564           }
  565           else {
  566               throw new IllegalArgumentException("No date or time style specified");
  567           }
  568   
  569           initialize(loc);
  570       }
  571   
  572       /* Initialize compiledPattern and numberFormat fields */
  573       private void initialize(Locale loc) {
  574           // Verify and compile the given pattern.
  575           compiledPattern = compile(pattern);
  576   
  577           /* try the cache first */
  578           numberFormat = cachedNumberFormatData.get(loc);
  579           if (numberFormat == null) { /* cache miss */
  580               numberFormat = NumberFormat.getIntegerInstance(loc);
  581               numberFormat.setGroupingUsed(false);
  582   
  583               /* update cache */
  584               cachedNumberFormatData.put(loc, numberFormat);
  585           }
  586           numberFormat = (NumberFormat) numberFormat.clone();
  587   
  588           initializeDefaultCentury();
  589       }
  590   
  591       private void initializeCalendar(Locale loc) {
  592           if (calendar == null) {
  593               assert loc != null;
  594               // The format object must be constructed using the symbols for this zone.
  595               // However, the calendar should use the current default TimeZone.
  596               // If this is not contained in the locale zone strings, then the zone
  597               // will be formatted using generic GMT+/-H:MM nomenclature.
  598               calendar = Calendar.getInstance(TimeZone.getDefault(), loc);
  599           }
  600       }
  601   
  602       private String getKey() {
  603           StringBuilder sb = new StringBuilder();
  604           sb.append(getCalendarName()).append('.');
  605           sb.append(locale.getLanguage()).append('_').append(locale.getCountry()).append('_').append(locale.getVariant());
  606           return sb.toString();
  607       }
  608   
  609       /**
  610        * Returns the compiled form of the given pattern. The syntax of
  611        * the compiled pattern is:
  612        * <blockquote>
  613        * CompiledPattern:
  614        *     EntryList
  615        * EntryList:
  616        *     Entry
  617        *     EntryList Entry
  618        * Entry:
  619        *     TagField
  620        *     TagField data
  621        * TagField:
  622        *     Tag Length
  623        *     TaggedData
  624        * Tag:
  625        *     pattern_char_index
  626        *     TAG_QUOTE_CHARS
  627        * Length:
  628        *     short_length
  629        *     long_length
  630        * TaggedData:
  631        *     TAG_QUOTE_ASCII_CHAR ascii_char
  632        *
  633        * </blockquote>
  634        *
  635        * where `short_length' is an 8-bit unsigned integer between 0 and
  636        * 254.  `long_length' is a sequence of an 8-bit integer 255 and a
  637        * 32-bit signed integer value which is split into upper and lower
  638        * 16-bit fields in two char's. `pattern_char_index' is an 8-bit
  639        * integer between 0 and 18. `ascii_char' is an 7-bit ASCII
  640        * character value. `data' depends on its Tag value.
  641        * <p>
  642        * If Length is short_length, Tag and short_length are packed in a
  643        * single char, as illustrated below.
  644        * <blockquote>
  645        *     char[0] = (Tag << 8) | short_length;
  646        * </blockquote>
  647        *
  648        * If Length is long_length, Tag and 255 are packed in the first
  649        * char and a 32-bit integer, as illustrated below.
  650        * <blockquote>
  651        *     char[0] = (Tag << 8) | 255;
  652        *     char[1] = (char) (long_length >>> 16);
  653        *     char[2] = (char) (long_length & 0xffff);
  654        * </blockquote>
  655        * <p>
  656        * If Tag is a pattern_char_index, its Length is the number of
  657        * pattern characters. For example, if the given pattern is
  658        * "yyyy", Tag is 1 and Length is 4, followed by no data.
  659        * <p>
  660        * If Tag is TAG_QUOTE_CHARS, its Length is the number of char's
  661        * following the TagField. For example, if the given pattern is
  662        * "'o''clock'", Length is 7 followed by a char sequence of
  663        * <code>o&nbs;'&nbs;c&nbs;l&nbs;o&nbs;c&nbs;k</code>.
  664        * <p>
  665        * TAG_QUOTE_ASCII_CHAR is a special tag and has an ASCII
  666        * character in place of Length. For example, if the given pattern
  667        * is "'o'", the TaggedData entry is
  668        * <code>((TAG_QUOTE_ASCII_CHAR&nbs;<<&nbs;8)&nbs;|&nbs;'o')</code>.
  669        *
  670        * @exception NullPointerException if the given pattern is null
  671        * @exception IllegalArgumentException if the given pattern is invalid
  672        */
  673       private char[] compile(String pattern) {
  674           int length = pattern.length();
  675           boolean inQuote = false;
  676           StringBuilder compiledPattern = new StringBuilder(length * 2);
  677           StringBuilder tmpBuffer = null;
  678           int count = 0;
  679           int lastTag = -1;
  680   
  681           for (int i = 0; i < length; i++) {
  682               char c = pattern.charAt(i);
  683   
  684               if (c == '\'') {
  685                   // '' is treated as a single quote regardless of being
  686                   // in a quoted section.
  687                   if ((i + 1) < length) {
  688                       c = pattern.charAt(i + 1);
  689                       if (c == '\'') {
  690                           i++;
  691                           if (count != 0) {
  692                               encode(lastTag, count, compiledPattern);
  693                               lastTag = -1;
  694                               count = 0;
  695                           }
  696                           if (inQuote) {
  697                               tmpBuffer.append(c);
  698                           } else {
  699                               compiledPattern.append((char)(TAG_QUOTE_ASCII_CHAR << 8 | c));
  700                           }
  701                           continue;
  702                       }
  703                   }
  704                   if (!inQuote) {
  705                       if (count != 0) {
  706                           encode(lastTag, count, compiledPattern);
  707                           lastTag = -1;
  708                           count = 0;
  709                       }
  710                       if (tmpBuffer == null) {
  711                           tmpBuffer = new StringBuilder(length);
  712                       } else {
  713                           tmpBuffer.setLength(0);
  714                       }
  715                       inQuote = true;
  716                   } else {
  717                       int len = tmpBuffer.length();
  718                       if (len == 1) {
  719                           char ch = tmpBuffer.charAt(0);
  720                           if (ch < 128) {
  721                               compiledPattern.append((char)(TAG_QUOTE_ASCII_CHAR << 8 | ch));
  722                           } else {
  723                               compiledPattern.append((char)(TAG_QUOTE_CHARS << 8 | 1));
  724                               compiledPattern.append(ch);
  725                           }
  726                       } else {
  727                           encode(TAG_QUOTE_CHARS, len, compiledPattern);
  728                           compiledPattern.append(tmpBuffer);
  729                       }
  730                       inQuote = false;
  731                   }
  732                   continue;
  733               }
  734               if (inQuote) {
  735                   tmpBuffer.append(c);
  736                   continue;
  737               }
  738               if (!(c >= 'a' && c <= 'z' || c >= 'A' && c <= 'Z')) {
  739                   if (count != 0) {
  740                       encode(lastTag, count, compiledPattern);
  741                       lastTag = -1;
  742                       count = 0;
  743                   }
  744                   if (c < 128) {
  745                       // In most cases, c would be a delimiter, such as ':'.
  746                       compiledPattern.append((char)(TAG_QUOTE_ASCII_CHAR << 8 | c));
  747                   } else {
  748                       // Take any contiguous non-ASCII alphabet characters and
  749                       // put them in a single TAG_QUOTE_CHARS.
  750                       int j;
  751                       for (j = i + 1; j < length; j++) {
  752                           char d = pattern.charAt(j);
  753                           if (d == '\'' || (d >= 'a' && d <= 'z' || d >= 'A' && d <= 'Z')) {
  754                               break;
  755                           }
  756                       }
  757                       compiledPattern.append((char)(TAG_QUOTE_CHARS << 8 | (j - i)));
  758                       for (; i < j; i++) {
  759                           compiledPattern.append(pattern.charAt(i));
  760                       }
  761                       i--;
  762                   }
  763                   continue;
  764               }
  765   
  766               int tag;
  767               if ((tag = DateFormatSymbols.patternChars.indexOf(c)) == -1) {
  768                   throw new IllegalArgumentException("Illegal pattern character " +
  769                                                      "'" + c + "'");
  770               }
  771               if (lastTag == -1 || lastTag == tag) {
  772                   lastTag = tag;
  773                   count++;
  774                   continue;
  775               }
  776               encode(lastTag, count, compiledPattern);
  777               lastTag = tag;
  778               count = 1;
  779           }
  780   
  781           if (inQuote) {
  782               throw new IllegalArgumentException("Unterminated quote");
  783           }
  784   
  785           if (count != 0) {
  786               encode(lastTag, count, compiledPattern);
  787           }
  788   
  789           // Copy the compiled pattern to a char array
  790           int len = compiledPattern.length();
  791           char[] r = new char[len];
  792           compiledPattern.getChars(0, len, r, 0);
  793           return r;
  794       }
  795   
  796       /**
  797        * Encodes the given tag and length and puts encoded char(s) into buffer.
  798        */
  799       private static final void encode(int tag, int length, StringBuilder buffer) {
  800           if (length < 255) {
  801               buffer.append((char)(tag << 8 | length));
  802           } else {
  803               buffer.append((char)((tag << 8) | 0xff));
  804               buffer.append((char)(length >>> 16));
  805               buffer.append((char)(length & 0xffff));
  806           }
  807       }
  808   
  809       /* Initialize the fields we use to disambiguate ambiguous years. Separate
  810        * so we can call it from readObject().
  811        */
  812       private void initializeDefaultCentury() {
  813           calendar.setTime( new Date() );
  814           calendar.add( Calendar.YEAR, -80 );
  815           parseAmbiguousDatesAsAfter(calendar.getTime());
  816       }
  817   
  818       /* Define one-century window into which to disambiguate dates using
  819        * two-digit years.
  820        */
  821       private void parseAmbiguousDatesAsAfter(Date startDate) {
  822           defaultCenturyStart = startDate;
  823           calendar.setTime(startDate);
  824           defaultCenturyStartYear = calendar.get(Calendar.YEAR);
  825       }
  826   
  827       /**
  828        * Sets the 100-year period 2-digit years will be interpreted as being in
  829        * to begin on the date the user specifies.
  830        *
  831        * @param startDate During parsing, two digit years will be placed in the range
  832        * <code>startDate</code> to <code>startDate + 100 years</code>.
  833        * @see #get2DigitYearStart
  834        * @since 1.2
  835        */
  836       public void set2DigitYearStart(Date startDate) {
  837           parseAmbiguousDatesAsAfter(startDate);
  838       }
  839   
  840       /**
  841        * Returns the beginning date of the 100-year period 2-digit years are interpreted
  842        * as being within.
  843        *
  844        * @return the start of the 100-year period into which two digit years are
  845        * parsed
  846        * @see #set2DigitYearStart
  847        * @since 1.2
  848        */
  849       public Date get2DigitYearStart() {
  850           return defaultCenturyStart;
  851       }
  852   
  853       /**
  854        * Formats the given <code>Date</code> into a date/time string and appends
  855        * the result to the given <code>StringBuffer</code>.
  856        *
  857        * @param date the date-time value to be formatted into a date-time string.
  858        * @param toAppendTo where the new date-time text is to be appended.
  859        * @param pos the formatting position. On input: an alignment field,
  860        * if desired. On output: the offsets of the alignment field.
  861        * @return the formatted date-time string.
  862        * @exception NullPointerException if the given date is null
  863        */
  864       public StringBuffer format(Date date, StringBuffer toAppendTo,
  865                                  FieldPosition pos)
  866       {
  867           pos.beginIndex = pos.endIndex = 0;
  868           return format(date, toAppendTo, pos.getFieldDelegate());
  869       }
  870   
  871       // Called from Format after creating a FieldDelegate
  872       private StringBuffer format(Date date, StringBuffer toAppendTo,
  873                                   FieldDelegate delegate) {
  874           // Convert input date to time field list
  875           calendar.setTime(date);
  876   
  877           boolean useDateFormatSymbols = useDateFormatSymbols();
  878   
  879           for (int i = 0; i < compiledPattern.length; ) {
  880               int tag = compiledPattern[i] >>> 8;
  881               int count = compiledPattern[i++] & 0xff;
  882               if (count == 255) {
  883                   count = compiledPattern[i++] << 16;
  884                   count |= compiledPattern[i++];
  885               }
  886   
  887               switch (tag) {
  888               case TAG_QUOTE_ASCII_CHAR:
  889                   toAppendTo.append((char)count);
  890                   break;
  891   
  892               case TAG_QUOTE_CHARS:
  893                   toAppendTo.append(compiledPattern, i, count);
  894                   i += count;
  895                   break;
  896   
  897               default:
  898                   subFormat(tag, count, delegate, toAppendTo, useDateFormatSymbols);
  899                   break;
  900               }
  901           }
  902           return toAppendTo;
  903       }
  904   
  905       /**
  906        * Formats an Object producing an <code>AttributedCharacterIterator</code>.
  907        * You can use the returned <code>AttributedCharacterIterator</code>
  908        * to build the resulting String, as well as to determine information
  909        * about the resulting String.
  910        * <p>
  911        * Each attribute key of the AttributedCharacterIterator will be of type
  912        * <code>DateFormat.Field</code>, with the corresponding attribute value
  913        * being the same as the attribute key.
  914        *
  915        * @exception NullPointerException if obj is null.
  916        * @exception IllegalArgumentException if the Format cannot format the
  917        *            given object, or if the Format's pattern string is invalid.
  918        * @param obj The object to format
  919        * @return AttributedCharacterIterator describing the formatted value.
  920        * @since 1.4
  921        */
  922       public AttributedCharacterIterator formatToCharacterIterator(Object obj) {
  923           StringBuffer sb = new StringBuffer();
  924           CharacterIteratorFieldDelegate delegate = new
  925                            CharacterIteratorFieldDelegate();
  926   
  927           if (obj instanceof Date) {
  928               format((Date)obj, sb, delegate);
  929           }
  930           else if (obj instanceof Number) {
  931               format(new Date(((Number)obj).longValue()), sb, delegate);
  932           }
  933           else if (obj == null) {
  934               throw new NullPointerException(
  935                      "formatToCharacterIterator must be passed non-null object");
  936           }
  937           else {
  938               throw new IllegalArgumentException(
  939                                "Cannot format given Object as a Date");
  940           }
  941           return delegate.getIterator(sb.toString());
  942       }
  943   
  944       // Map index into pattern character string to Calendar field number
  945       private static final int[] PATTERN_INDEX_TO_CALENDAR_FIELD =
  946       {
  947           Calendar.ERA, Calendar.YEAR, Calendar.MONTH, Calendar.DATE,
  948           Calendar.HOUR_OF_DAY, Calendar.HOUR_OF_DAY, Calendar.MINUTE,
  949           Calendar.SECOND, Calendar.MILLISECOND, Calendar.DAY_OF_WEEK,
  950           Calendar.DAY_OF_YEAR, Calendar.DAY_OF_WEEK_IN_MONTH,
  951           Calendar.WEEK_OF_YEAR, Calendar.WEEK_OF_MONTH,
  952           Calendar.AM_PM, Calendar.HOUR, Calendar.HOUR, Calendar.ZONE_OFFSET,
  953           Calendar.ZONE_OFFSET
  954       };
  955   
  956       // Map index into pattern character string to DateFormat field number
  957       private static final int[] PATTERN_INDEX_TO_DATE_FORMAT_FIELD = {
  958           DateFormat.ERA_FIELD, DateFormat.YEAR_FIELD, DateFormat.MONTH_FIELD,
  959           DateFormat.DATE_FIELD, DateFormat.HOUR_OF_DAY1_FIELD,
  960           DateFormat.HOUR_OF_DAY0_FIELD, DateFormat.MINUTE_FIELD,
  961           DateFormat.SECOND_FIELD, DateFormat.MILLISECOND_FIELD,
  962           DateFormat.DAY_OF_WEEK_FIELD, DateFormat.DAY_OF_YEAR_FIELD,
  963           DateFormat.DAY_OF_WEEK_IN_MONTH_FIELD, DateFormat.WEEK_OF_YEAR_FIELD,
  964           DateFormat.WEEK_OF_MONTH_FIELD, DateFormat.AM_PM_FIELD,
  965           DateFormat.HOUR1_FIELD, DateFormat.HOUR0_FIELD,
  966           DateFormat.TIMEZONE_FIELD, DateFormat.TIMEZONE_FIELD,
  967       };
  968   
  969       // Maps from DecimalFormatSymbols index to Field constant
  970       private static final Field[] PATTERN_INDEX_TO_DATE_FORMAT_FIELD_ID = {
  971           Field.ERA, Field.YEAR, Field.MONTH, Field.DAY_OF_MONTH,
  972           Field.HOUR_OF_DAY1, Field.HOUR_OF_DAY0, Field.MINUTE,
  973           Field.SECOND, Field.MILLISECOND, Field.DAY_OF_WEEK,
  974           Field.DAY_OF_YEAR, Field.DAY_OF_WEEK_IN_MONTH,
  975           Field.WEEK_OF_YEAR, Field.WEEK_OF_MONTH,
  976           Field.AM_PM, Field.HOUR1, Field.HOUR0, Field.TIME_ZONE,
  977           Field.TIME_ZONE,
  978       };
  979   
  980       /**
  981        * Private member function that does the real date/time formatting.
  982        */
  983       private void subFormat(int patternCharIndex, int count,
  984                              FieldDelegate delegate, StringBuffer buffer,
  985                              boolean useDateFormatSymbols)
  986       {
  987           int     maxIntCount = Integer.MAX_VALUE;
  988           String  current = null;
  989           int     beginOffset = buffer.length();
  990   
  991           int field = PATTERN_INDEX_TO_CALENDAR_FIELD[patternCharIndex];
  992           int value = calendar.get(field);
  993           int style = (count >= 4) ? Calendar.LONG : Calendar.SHORT;
  994           if (!useDateFormatSymbols) {
  995               current = calendar.getDisplayName(field, style, locale);
  996           }
  997   
  998           // Note: zeroPaddingNumber() assumes that maxDigits is either
  999           // 2 or maxIntCount. If we make any changes to this,
 1000           // zeroPaddingNumber() must be fixed.
 1001   
 1002           switch (patternCharIndex) {
 1003           case 0: // 'G' - ERA
 1004               if (useDateFormatSymbols) {
 1005                   String[] eras = formatData.getEras();
 1006                   if (value < eras.length)
 1007                       current = eras[value];
 1008               }
 1009               if (current == null)
 1010                   current = "";
 1011               break;
 1012   
 1013           case 1: // 'y' - YEAR
 1014               if (calendar instanceof GregorianCalendar) {
 1015                   if (count >= 4)
 1016                       zeroPaddingNumber(value, count, maxIntCount, buffer);
 1017                   else // count < 4
 1018                       zeroPaddingNumber(value, 2, 2, buffer); // clip 1996 to 96
 1019               } else {
 1020                   if (current == null) {
 1021                       zeroPaddingNumber(value, style == Calendar.LONG ? 1 : count,
 1022                                         maxIntCount, buffer);
 1023                   }
 1024               }
 1025               break;
 1026   
 1027           case 2: // 'M' - MONTH
 1028               if (useDateFormatSymbols) {
 1029                   String[] months;
 1030                   if (count >= 4) {
 1031                       months = formatData.getMonths();
 1032                       current = months[value];
 1033                   } else if (count == 3) {
 1034                       months = formatData.getShortMonths();
 1035                       current = months[value];
 1036                   }
 1037               } else {
 1038                   if (count < 3) {
 1039                       current = null;
 1040                   }
 1041               }
 1042               if (current == null) {
 1043                   zeroPaddingNumber(value+1, count, maxIntCount, buffer);
 1044               }
 1045               break;
 1046   
 1047           case 4: // 'k' - HOUR_OF_DAY: 1-based.  eg, 23:59 + 1 hour =>> 24:59
 1048               if (current == null) {
 1049                   if (value == 0)
 1050                       zeroPaddingNumber(calendar.getMaximum(Calendar.HOUR_OF_DAY)+1,
 1051                                         count, maxIntCount, buffer);
 1052                   else
 1053                       zeroPaddingNumber(value, count, maxIntCount, buffer);
 1054               }
 1055               break;
 1056   
 1057           case 9: // 'E' - DAY_OF_WEEK
 1058               if (useDateFormatSymbols) {
 1059                   String[] weekdays;
 1060                   if (count >= 4) {
 1061                       weekdays = formatData.getWeekdays();
 1062                       current = weekdays[value];
 1063                   } else { // count < 4, use abbreviated form if exists
 1064                       weekdays = formatData.getShortWeekdays();
 1065                       current = weekdays[value];
 1066                   }
 1067               }
 1068               break;
 1069   
 1070           case 14:    // 'a' - AM_PM
 1071               if (useDateFormatSymbols) {
 1072                   String[] ampm = formatData.getAmPmStrings();
 1073                   current = ampm[value];
 1074               }
 1075               break;
 1076   
 1077           case 15: // 'h' - HOUR:1-based.  eg, 11PM + 1 hour =>> 12 AM
 1078               if (current == null) {
 1079                   if (value == 0)
 1080                       zeroPaddingNumber(calendar.getLeastMaximum(Calendar.HOUR)+1,
 1081                                         count, maxIntCount, buffer);
 1082                   else
 1083                       zeroPaddingNumber(value, count, maxIntCount, buffer);
 1084               }
 1085               break;
 1086   
 1087           case 17: // 'z' - ZONE_OFFSET
 1088               if (current == null) {
 1089                   if (formatData.locale == null || formatData.isZoneStringsSet) {
 1090                       int zoneIndex =
 1091                           formatData.getZoneIndex(calendar.getTimeZone().getID());
 1092                       if (zoneIndex == -1) {
 1093                           value = calendar.get(Calendar.ZONE_OFFSET) +
 1094                               calendar.get(Calendar.DST_OFFSET);
 1095                           buffer.append(ZoneInfoFile.toCustomID(value));
 1096                       } else {
 1097                           int index = (calendar.get(Calendar.DST_OFFSET) == 0) ? 1: 3;
 1098                           if (count < 4) {
 1099                               // Use the short name
 1100                               index++;
 1101                           }
 1102                           String[][] zoneStrings = formatData.getZoneStringsWrapper();
 1103                           buffer.append(zoneStrings[zoneIndex][index]);
 1104                       }
 1105                   } else {
 1106                       TimeZone tz = calendar.getTimeZone();
 1107                       boolean daylight = (calendar.get(Calendar.DST_OFFSET) != 0);
 1108                       int tzstyle = (count < 4 ? TimeZone.SHORT : TimeZone.LONG);
 1109                       buffer.append(tz.getDisplayName(daylight, tzstyle, formatData.locale));
 1110                   }
 1111               }
 1112               break;
 1113   
 1114           case 18: // 'Z' - ZONE_OFFSET ("-/+hhmm" form)
 1115               value = (calendar.get(Calendar.ZONE_OFFSET) +
 1116                        calendar.get(Calendar.DST_OFFSET)) / 60000;
 1117   
 1118               int width = 4;
 1119               if (value >= 0) {
 1120                   buffer.append('+');
 1121               } else {
 1122                   width++;
 1123               }
 1124   
 1125               int num = (value / 60) * 100 + (value % 60);
 1126               CalendarUtils.sprintf0d(buffer, num, width);
 1127               break;
 1128   
 1129           default:
 1130               // case 3: // 'd' - DATE
 1131               // case 5: // 'H' - HOUR_OF_DAY:0-based.  eg, 23:59 + 1 hour =>> 00:59
 1132               // case 6: // 'm' - MINUTE
 1133               // case 7: // 's' - SECOND
 1134               // case 8: // 'S' - MILLISECOND
 1135               // case 10: // 'D' - DAY_OF_YEAR
 1136               // case 11: // 'F' - DAY_OF_WEEK_IN_MONTH
 1137               // case 12: // 'w' - WEEK_OF_YEAR
 1138               // case 13: // 'W' - WEEK_OF_MONTH
 1139               // case 16: // 'K' - HOUR: 0-based.  eg, 11PM + 1 hour =>> 0 AM
 1140               if (current == null) {
 1141                   zeroPaddingNumber(value, count, maxIntCount, buffer);
 1142               }
 1143               break;
 1144           } // switch (patternCharIndex)
 1145   
 1146           if (current != null) {
 1147               buffer.append(current);
 1148           }
 1149   
 1150           int fieldID = PATTERN_INDEX_TO_DATE_FORMAT_FIELD[patternCharIndex];
 1151           Field f = PATTERN_INDEX_TO_DATE_FORMAT_FIELD_ID[patternCharIndex];
 1152   
 1153           delegate.formatted(fieldID, f, f, beginOffset, buffer.length(), buffer);
 1154       }
 1155   
 1156       /**
 1157        * Formats a number with the specified minimum and maximum number of digits.
 1158        */
 1159       private final void zeroPaddingNumber(int value, int minDigits, int maxDigits, StringBuffer buffer)
 1160       {
 1161           // Optimization for 1, 2 and 4 digit numbers. This should
 1162           // cover most cases of formatting date/time related items.
 1163           // Note: This optimization code assumes that maxDigits is
 1164           // either 2 or Integer.MAX_VALUE (maxIntCount in format()).
 1165           try {
 1166               if (zeroDigit == 0) {
 1167                   zeroDigit = ((DecimalFormat)numberFormat).getDecimalFormatSymbols().getZeroDigit();
 1168               }
 1169               if (value >= 0) {
 1170                   if (value < 100 && minDigits >= 1 && minDigits <= 2) {
 1171                       if (value < 10) {
 1172                           if (minDigits == 2) {
 1173                               buffer.append(zeroDigit);
 1174                           }
 1175                           buffer.append((char)(zeroDigit + value));
 1176                       } else {
 1177                           buffer.append((char)(zeroDigit + value / 10));
 1178                           buffer.append((char)(zeroDigit + value % 10));
 1179                       }
 1180                       return;
 1181                   } else if (value >= 1000 && value < 10000) {
 1182                       if (minDigits == 4) {
 1183                           buffer.append((char)(zeroDigit + value / 1000));
 1184                           value %= 1000;
 1185                           buffer.append((char)(zeroDigit + value / 100));
 1186                           value %= 100;
 1187                           buffer.append((char)(zeroDigit + value / 10));
 1188                           buffer.append((char)(zeroDigit + value % 10));
 1189                           return;
 1190                       }
 1191                       if (minDigits == 2 && maxDigits == 2) {
 1192                           zeroPaddingNumber(value % 100, 2, 2, buffer);
 1193                           return;
 1194                       }
 1195                   }
 1196               }
 1197           } catch (Exception e) {
 1198           }
 1199   
 1200           numberFormat.setMinimumIntegerDigits(minDigits);
 1201           numberFormat.setMaximumIntegerDigits(maxDigits);
 1202           numberFormat.format((long)value, buffer, DontCareFieldPosition.INSTANCE);
 1203       }
 1204   
 1205   
 1206       /**
 1207        * Parses text from a string to produce a <code>Date</code>.
 1208        * <p>
 1209        * The method attempts to parse text starting at the index given by
 1210        * <code>pos</code>.
 1211        * If parsing succeeds, then the index of <code>pos</code> is updated
 1212        * to the index after the last character used (parsing does not necessarily
 1213        * use all characters up to the end of the string), and the parsed
 1214        * date is returned. The updated <code>pos</code> can be used to
 1215        * indicate the starting point for the next call to this method.
 1216        * If an error occurs, then the index of <code>pos</code> is not
 1217        * changed, the error index of <code>pos</code> is set to the index of
 1218        * the character where the error occurred, and null is returned.
 1219        *
 1220        * @param text  A <code>String</code>, part of which should be parsed.
 1221        * @param pos   A <code>ParsePosition</code> object with index and error
 1222        *              index information as described above.
 1223        * @return A <code>Date</code> parsed from the string. In case of
 1224        *         error, returns null.
 1225        * @exception NullPointerException if <code>text</code> or <code>pos</code> is null.
 1226        */
 1227       public Date parse(String text, ParsePosition pos)
 1228       {
 1229           int start = pos.index;
 1230           int oldStart = start;
 1231           int textLength = text.length();
 1232   
 1233           calendar.clear(); // Clears all the time fields
 1234   
 1235           boolean[] ambiguousYear = {false};
 1236   
 1237   
 1238           for (int i = 0; i < compiledPattern.length; ) {
 1239               int tag = compiledPattern[i] >>> 8;
 1240               int count = compiledPattern[i++] & 0xff;
 1241               if (count == 255) {
 1242                   count = compiledPattern[i++] << 16;
 1243                   count |= compiledPattern[i++];
 1244               }
 1245   
 1246               switch (tag) {
 1247               case TAG_QUOTE_ASCII_CHAR:
 1248                   if (start >= textLength || text.charAt(start) != (char)count) {
 1249                       pos.index = oldStart;
 1250                       pos.errorIndex = start;
 1251                       return null;
 1252                   }
 1253                   start++;
 1254                   break;
 1255   
 1256               case TAG_QUOTE_CHARS:
 1257                   while (count-- > 0) {
 1258                       if (start >= textLength || text.charAt(start) != compiledPattern[i++]) {
 1259                           pos.index = oldStart;
 1260                           pos.errorIndex = start;
 1261                           return null;
 1262                       }
 1263                       start++;
 1264                   }
 1265                   break;
 1266   
 1267               default:
 1268                   // Peek the next pattern to determine if we need to
 1269                   // obey the number of pattern letters for
 1270                   // parsing. It's required when parsing contiguous
 1271                   // digit text (e.g., "20010704") with a pattern which
 1272                   // has no delimiters between fields, like "yyyyMMdd".
 1273                   boolean obeyCount = false;
 1274                   if (i < compiledPattern.length) {
 1275                       int nextTag = compiledPattern[i] >>> 8;
 1276                       if (!(nextTag == TAG_QUOTE_ASCII_CHAR || nextTag == TAG_QUOTE_CHARS)) {
 1277                           obeyCount = true;
 1278                       }
 1279                   }
 1280                   start = subParse(text, start, tag, count, obeyCount,
 1281                                    ambiguousYear, pos);
 1282                   if (start < 0) {
 1283                       pos.index = oldStart;
 1284                       return null;
 1285                   }
 1286               }
 1287           }
 1288   
 1289           // At this point the fields of Calendar have been set.  Calendar
 1290           // will fill in default values for missing fields when the time
 1291           // is computed.
 1292   
 1293           pos.index = start;
 1294   
 1295           // This part is a problem:  When we call parsedDate.after, we compute the time.
 1296           // Take the date April 3 2004 at 2:30 am.  When this is first set up, the year
 1297           // will be wrong if we're parsing a 2-digit year pattern.  It will be 1904.
 1298           // April 3 1904 is a Sunday (unlike 2004) so it is the DST onset day.  2:30 am
 1299           // is therefore an "impossible" time, since the time goes from 1:59 to 3:00 am
 1300           // on that day.  It is therefore parsed out to fields as 3:30 am.  Then we
 1301           // add 100 years, and get April 3 2004 at 3:30 am.  Note that April 3 2004 is
 1302           // a Saturday, so it can have a 2:30 am -- and it should. [LIU]
 1303           /*
 1304           Date parsedDate = calendar.getTime();
 1305           if( ambiguousYear[0] && !parsedDate.after(defaultCenturyStart) ) {
 1306               calendar.add(Calendar.YEAR, 100);
 1307               parsedDate = calendar.getTime();
 1308           }
 1309           */
 1310           // Because of the above condition, save off the fields in case we need to readjust.
 1311           // The procedure we use here is not particularly efficient, but there is no other
 1312           // way to do this given the API restrictions present in Calendar.  We minimize
 1313           // inefficiency by only performing this computation when it might apply, that is,
 1314           // when the two-digit year is equal to the start year, and thus might fall at the
 1315           // front or the back of the default century.  This only works because we adjust
 1316           // the year correctly to start with in other cases -- see subParse().
 1317           Date parsedDate;
 1318           try {
 1319               if (ambiguousYear[0]) // If this is true then the two-digit year == the default start year
 1320               {
 1321                   // We need a copy of the fields, and we need to avoid triggering a call to
 1322                   // complete(), which will recalculate the fields.  Since we can't access
 1323                   // the fields[] array in Calendar, we clone the entire object.  This will
 1324                   // stop working if Calendar.clone() is ever rewritten to call complete().
 1325                   Calendar savedCalendar = (Calendar)calendar.clone();
 1326                   parsedDate = calendar.getTime();
 1327                   if (parsedDate.before(defaultCenturyStart))
 1328                   {
 1329                       // We can't use add here because that does a complete() first.
 1330                       savedCalendar.set(Calendar.YEAR, defaultCenturyStartYear + 100);
 1331                       parsedDate = savedCalendar.getTime();
 1332                   }
 1333               }
 1334               else parsedDate = calendar.getTime();
 1335           }
 1336           // An IllegalArgumentException will be thrown by Calendar.getTime()
 1337           // if any fields are out of range, e.g., MONTH == 17.
 1338           catch (IllegalArgumentException e) {
 1339               pos.errorIndex = start;
 1340               pos.index = oldStart;
 1341               return null;
 1342           }
 1343   
 1344           return parsedDate;
 1345       }
 1346   
 1347       /**
 1348        * Private code-size reduction function used by subParse.
 1349        * @param text the time text being parsed.
 1350        * @param start where to start parsing.
 1351        * @param field the date field being parsed.
 1352        * @param data the string array to parsed.
 1353        * @return the new start position if matching succeeded; a negative number
 1354        * indicating matching failure, otherwise.
 1355        */
 1356       private int matchString(String text, int start, int field, String[] data)
 1357       {
 1358           int i = 0;
 1359           int count = data.length;
 1360   
 1361           if (field == Calendar.DAY_OF_WEEK) i = 1;
 1362   
 1363           // There may be multiple strings in the data[] array which begin with
 1364           // the same prefix (e.g., Cerven and Cervenec (June and July) in Czech).
 1365           // We keep track of the longest match, and return that.  Note that this
 1366           // unfortunately requires us to test all array elements.
 1367           int bestMatchLength = 0, bestMatch = -1;
 1368           for (; i<count; ++i)
 1369           {
 1370               int length = data[i].length();
 1371               // Always compare if we have no match yet; otherwise only compare
 1372               // against potentially better matches (longer strings).
 1373               if (length > bestMatchLength &&
 1374                   text.regionMatches(true, start, data[i], 0, length))
 1375               {
 1376                   bestMatch = i;
 1377                   bestMatchLength = length;
 1378               }
 1379           }
 1380           if (bestMatch >= 0)
 1381           {
 1382               calendar.set(field, bestMatch);
 1383               return start + bestMatchLength;
 1384           }
 1385           return -start;
 1386       }
 1387   
 1388       /**
 1389        * Performs the same thing as matchString(String, int, int,
 1390        * String[]). This method takes a Map<String, Integer> instead of
 1391        * String[].
 1392        */
 1393       private int matchString(String text, int start, int field, Map<String,Integer> data) {
 1394           if (data != null) {
 1395               String bestMatch = null;
 1396   
 1397               for (String name : data.keySet()) {
 1398                   int length = name.length();
 1399                   if (bestMatch == null || length > bestMatch.length()) {
 1400                       if (text.regionMatches(true, start, name, 0, length)) {
 1401                           bestMatch = name;
 1402                       }
 1403                   }
 1404               }
 1405   
 1406               if (bestMatch != null) {
 1407                   calendar.set(field, data.get(bestMatch));
 1408                   return start + bestMatch.length();
 1409               }
 1410           }
 1411           return -start;
 1412       }
 1413   
 1414       private int matchZoneString(String text, int start, String[] zoneNames) {
 1415           for (int i = 1; i <= 4; ++i) {
 1416               // Checking long and short zones [1 & 2],
 1417               // and long and short daylight [3 & 4].
 1418               String zoneName = zoneNames[i];
 1419               if (text.regionMatches(true, start,
 1420                                      zoneName, 0, zoneName.length())) {
 1421                   return i;
 1422               }
 1423           }
 1424           return -1;
 1425       }
 1426   
 1427       /**
 1428        * find time zone 'text' matched zoneStrings and set to internal
 1429        * calendar.
 1430        */
 1431       private int subParseZoneString(String text, int start) {
 1432           boolean useSameName = false; // true if standard and daylight time use the same abbreviation.
 1433           TimeZone currentTimeZone = getTimeZone();
 1434   
 1435           // At this point, check for named time zones by looking through
 1436           // the locale data from the TimeZoneNames strings.
 1437           // Want to be able to parse both short and long forms.
 1438           int zoneIndex = formatData.getZoneIndex(currentTimeZone.getID());
 1439           TimeZone tz = null;
 1440           String[][] zoneStrings = formatData.getZoneStringsWrapper();
 1441           String[] zoneNames = null;
 1442           int nameIndex = 0;
 1443           if (zoneIndex != -1) {
 1444               zoneNames = zoneStrings[zoneIndex];
 1445               if ((nameIndex = matchZoneString(text, start, zoneNames)) > 0) {
 1446                   if (nameIndex <= 2) {
 1447                       // Check if the standard name (abbr) and the daylight name are the same.
 1448                       useSameName = zoneNames[nameIndex].equalsIgnoreCase(zoneNames[nameIndex + 2]);
 1449                   }
 1450                   tz = TimeZone.getTimeZone(zoneNames[0]);
 1451               }
 1452           }
 1453           if (tz == null) {
 1454               zoneIndex = formatData.getZoneIndex(TimeZone.getDefault().getID());
 1455               if (zoneIndex != -1) {
 1456                   zoneNames = zoneStrings[zoneIndex];
 1457                   if ((nameIndex = matchZoneString(text, start, zoneNames)) > 0) {
 1458                       if (nameIndex <= 2) {
 1459                           useSameName = zoneNames[nameIndex].equalsIgnoreCase(zoneNames[nameIndex + 2]);
 1460                       }
 1461                       tz = TimeZone.getTimeZone(zoneNames[0]);
 1462                   }
 1463               }
 1464           }
 1465           if (tz == null) {
 1466               int len = zoneStrings.length;
 1467               for (int i = 0; i < len; i++) {
 1468                   zoneNames = zoneStrings[i];
 1469                   if ((nameIndex = matchZoneString(text, start, zoneNames)) > 0) {
 1470                       if (nameIndex <= 2) {
 1471                           useSameName = zoneNames[nameIndex].equalsIgnoreCase(zoneNames[nameIndex + 2]);
 1472                       }
 1473                       tz = TimeZone.getTimeZone(zoneNames[0]);
 1474                       break;
 1475                   }
 1476               }
 1477           }
 1478           if (tz != null) { // Matched any ?
 1479               if (!tz.equals(currentTimeZone)) {
 1480                   setTimeZone(tz);
 1481               }
 1482               // If the time zone matched uses the same name
 1483               // (abbreviation) for both standard and daylight time,
 1484               // let the time zone in the Calendar decide which one.
 1485               if (!useSameName) {
 1486                   calendar.set(Calendar.ZONE_OFFSET, tz.getRawOffset());
 1487                   calendar.set(Calendar.DST_OFFSET,
 1488                                nameIndex >= 3 ? tz.getDSTSavings() : 0);
 1489               }
 1490               return (start + zoneNames[nameIndex].length());
 1491           }
 1492           return 0;
 1493       }
 1494   
 1495       /**
 1496        * Private member function that converts the parsed date strings into
 1497        * timeFields. Returns -start (for ParsePosition) if failed.
 1498        * @param text the time text to be parsed.
 1499        * @param start where to start parsing.
 1500        * @param ch the pattern character for the date field text to be parsed.
 1501        * @param count the count of a pattern character.
 1502        * @param obeyCount if true, then the next field directly abuts this one,
 1503        * and we should use the count to know when to stop parsing.
 1504        * @param ambiguousYear return parameter; upon return, if ambiguousYear[0]
 1505        * is true, then a two-digit year was parsed and may need to be readjusted.
 1506        * @param origPos origPos.errorIndex is used to return an error index
 1507        * at which a parse error occurred, if matching failure occurs.
 1508        * @return the new start position if matching succeeded; -1 indicating
 1509        * matching failure, otherwise. In case matching failure occurred,
 1510        * an error index is set to origPos.errorIndex.
 1511        */
 1512       private int subParse(String text, int start, int patternCharIndex, int count,
 1513                            boolean obeyCount, boolean[] ambiguousYear,
 1514                            ParsePosition origPos)
 1515       {
 1516           Number number = null;
 1517           int value = 0;
 1518           ParsePosition pos = new ParsePosition(0);
 1519           pos.index = start;
 1520           int field = PATTERN_INDEX_TO_CALENDAR_FIELD[patternCharIndex];
 1521   
 1522           // If there are any spaces here, skip over them.  If we hit the end
 1523           // of the string, then fail.
 1524           for (;;) {
 1525               if (pos.index >= text.length()) {
 1526                   origPos.errorIndex = start;
 1527                   return -1;
 1528               }
 1529               char c = text.charAt(pos.index);
 1530               if (c != ' ' && c != '\t') break;
 1531               ++pos.index;
 1532           }
 1533   
 1534         parsing:
 1535           {
 1536               // We handle a few special cases here where we need to parse
 1537               // a number value.  We handle further, more generic cases below.  We need
 1538               // to handle some of them here because some fields require extra processing on
 1539               // the parsed value.
 1540               if (patternCharIndex == 4 /*HOUR_OF_DAY1_FIELD*/ ||
 1541                   patternCharIndex == 15 /*HOUR1_FIELD*/ ||
 1542                   (patternCharIndex == 2 /*MONTH_FIELD*/ && count <= 2) ||
 1543                   patternCharIndex == 1) {
 1544                   // It would be good to unify this with the obeyCount logic below,
 1545                   // but that's going to be difficult.
 1546                   if (obeyCount) {
 1547                       if ((start+count) > text.length()) {
 1548                           break parsing;
 1549                       }
 1550                       number = numberFormat.parse(text.substring(0, start+count), pos);
 1551                   } else {
 1552                       number = numberFormat.parse(text, pos);
 1553                   }
 1554                   if (number == null) {
 1555                       if (patternCharIndex != 1 || calendar instanceof GregorianCalendar) {
 1556                           break parsing;
 1557                       }
 1558                   } else {
 1559                       value = number.intValue();
 1560                   }
 1561               }
 1562   
 1563               boolean useDateFormatSymbols = useDateFormatSymbols();
 1564   
 1565               int index;
 1566               switch (patternCharIndex) {
 1567               case 0: // 'G' - ERA
 1568                   if (useDateFormatSymbols) {
 1569                       if ((index = matchString(text, start, Calendar.ERA, formatData.getEras())) > 0) {
 1570                           return index;
 1571                       }
 1572                   } else {
 1573                       Map<String, Integer> map = calendar.getDisplayNames(field,
 1574                                                                           Calendar.ALL_STYLES,
 1575                                                                           locale);
 1576                       if ((index = matchString(text, start, field, map)) > 0) {
 1577                           return index;
 1578                       }
 1579                   }
 1580                   break parsing;
 1581   
 1582               case 1: // 'y' - YEAR
 1583                   if (!(calendar instanceof GregorianCalendar)) {
 1584                       // calendar might have text representations for year values,
 1585                       // such as "\u5143" in JapaneseImperialCalendar.
 1586                       int style = (count >= 4) ? Calendar.LONG : Calendar.SHORT;
 1587                       Map<String, Integer> map = calendar.getDisplayNames(field, style, locale);
 1588                       if (map != null) {
 1589                           if ((index = matchString(text, start, field, map)) > 0) {
 1590                               return index;
 1591                           }
 1592                       }
 1593                       calendar.set(field, value);
 1594                       return pos.index;
 1595                   }
 1596   
 1597                   // If there are 3 or more YEAR pattern characters, this indicates
 1598                   // that the year value is to be treated literally, without any
 1599                   // two-digit year adjustments (e.g., from "01" to 2001).  Otherwise
 1600                   // we made adjustments to place the 2-digit year in the proper
 1601                   // century, for parsed strings from "00" to "99".  Any other string
 1602                   // is treated literally:  "2250", "-1", "1", "002".
 1603                   if (count <= 2 && (pos.index - start) == 2
 1604                       && Character.isDigit(text.charAt(start))
 1605                       && Character.isDigit(text.charAt(start+1)))
 1606                   {
 1607                       // Assume for example that the defaultCenturyStart is 6/18/1903.
 1608                       // This means that two-digit years will be forced into the range
 1609                       // 6/18/1903 to 6/17/2003.  As a result, years 00, 01, and 02
 1610                       // correspond to 2000, 2001, and 2002.  Years 04, 05, etc. correspond
 1611                       // to 1904, 1905, etc.  If the year is 03, then it is 2003 if the
 1612                       // other fields specify a date before 6/18, or 1903 if they specify a
 1613                       // date afterwards.  As a result, 03 is an ambiguous year.  All other
 1614                       // two-digit years are unambiguous.
 1615                       int ambiguousTwoDigitYear = defaultCenturyStartYear % 100;
 1616                       ambiguousYear[0] = value == ambiguousTwoDigitYear;
 1617                       value += (defaultCenturyStartYear/100)*100 +
 1618                           (value < ambiguousTwoDigitYear ? 100 : 0);
 1619                   }
 1620                   calendar.set(Calendar.YEAR, value);
 1621                   return pos.index;
 1622   
 1623               case 2: // 'M' - MONTH
 1624                   if (count <= 2) // i.e., M or MM.
 1625                   {
 1626                       // Don't want to parse the month if it is a string
 1627                       // while pattern uses numeric style: M or MM.
 1628                       // [We computed 'value' above.]
 1629                       calendar.set(Calendar.MONTH, value - 1);
 1630                       return pos.index;
 1631                   }
 1632   
 1633                   if (useDateFormatSymbols) {
 1634                       // count >= 3 // i.e., MMM or MMMM
 1635                       // Want to be able to parse both short and long forms.
 1636                       // Try count == 4 first:
 1637                       int newStart = 0;
 1638                       if ((newStart = matchString(text, start, Calendar.MONTH,
 1639                                                   formatData.getMonths())) > 0) {
 1640                           return newStart;
 1641                       }
 1642                       // count == 4 failed, now try count == 3
 1643                       if ((index = matchString(text, start, Calendar.MONTH,
 1644                                                formatData.getShortMonths())) > 0) {
 1645                           return index;
 1646                       }
 1647                   } else {
 1648                       Map<String, Integer> map = calendar.getDisplayNames(field,
 1649                                                                           Calendar.ALL_STYLES,
 1650                                                                           locale);
 1651                       if ((index = matchString(text, start, field, map)) > 0) {
 1652                           return index;
 1653                       }
 1654                   }
 1655                   break parsing;
 1656   
 1657               case 4: // 'k' - HOUR_OF_DAY: 1-based.  eg, 23:59 + 1 hour =>> 24:59
 1658                   // [We computed 'value' above.]
 1659                   if (value == calendar.getMaximum(Calendar.HOUR_OF_DAY)+1) value = 0;
 1660                   calendar.set(Calendar.HOUR_OF_DAY, value);
 1661                   return pos.index;
 1662   
 1663               case 9:
 1664                   { // 'E' - DAY_OF_WEEK
 1665                       if (useDateFormatSymbols) {
 1666                           // Want to be able to parse both short and long forms.
 1667                           // Try count == 4 (DDDD) first:
 1668                           int newStart = 0;
 1669                           if ((newStart=matchString(text, start, Calendar.DAY_OF_WEEK,
 1670                                                     formatData.getWeekdays())) > 0) {
 1671                               return newStart;
 1672                           }
 1673                           // DDDD failed, now try DDD
 1674                           if ((index = matchString(text, start, Calendar.DAY_OF_WEEK,
 1675                                                    formatData.getShortWeekdays())) > 0) {
 1676                               return index;
 1677                           }
 1678                       } else {
 1679                           int[] styles = { Calendar.LONG, Calendar.SHORT };
 1680                           for (int style : styles) {
 1681                               Map<String,Integer> map = calendar.getDisplayNames(field, style, locale);
 1682                               if ((index = matchString(text, start, field, map)) > 0) {
 1683                                   return index;
 1684                               }
 1685                           }
 1686                       }
 1687                   }
 1688                   break parsing;
 1689   
 1690               case 14:    // 'a' - AM_PM
 1691                   if (useDateFormatSymbols) {
 1692                       if ((index = matchString(text, start, Calendar.AM_PM, formatData.getAmPmStrings())) > 0) {
 1693                           return index;
 1694                       }
 1695                   } else {
 1696                       Map<String,Integer> map = calendar.getDisplayNames(field, Calendar.ALL_STYLES, locale);
 1697                       if ((index = matchString(text, start, field, map)) > 0) {
 1698                           return index;
 1699                       }
 1700                   }
 1701                   break parsing;
 1702   
 1703               case 15: // 'h' - HOUR:1-based.  eg, 11PM + 1 hour =>> 12 AM
 1704                   // [We computed 'value' above.]
 1705                   if (value == calendar.getLeastMaximum(Calendar.HOUR)+1) value = 0;
 1706                   calendar.set(Calendar.HOUR, value);
 1707                   return pos.index;
 1708   
 1709               case 17: // 'z' - ZONE_OFFSET
 1710               case 18: // 'Z' - ZONE_OFFSET
 1711                   // First try to parse generic forms such as GMT-07:00. Do this first
 1712                   // in case localized TimeZoneNames contains the string "GMT"
 1713                   // for a zone; in that case, we don't want to match the first three
 1714                   // characters of GMT+/-hh:mm etc.
 1715                   {
 1716                       int sign = 0;
 1717                       int offset;
 1718   
 1719                       // For time zones that have no known names, look for strings
 1720                       // of the form:
 1721                       //    GMT[+-]hours:minutes or
 1722                       //    GMT.
 1723                       if ((text.length() - start) >= GMT.length() &&
 1724                           text.regionMatches(true, start, GMT, 0, GMT.length())) {
 1725                           int num;
 1726                           calendar.set(Calendar.DST_OFFSET, 0);
 1727                           pos.index = start + GMT.length();
 1728   
 1729                           try { // try-catch for "GMT" only time zone string
 1730                               char c = text.charAt(pos.index);
 1731                               if (c == '+') {
 1732                                   sign = 1;
 1733                               } else if (c == '-') {
 1734                                   sign = -1;
 1735                               }
 1736                           }
 1737                           catch(StringIndexOutOfBoundsException e) {}
 1738   
 1739                           if (sign == 0) {        /* "GMT" without offset */
 1740                               calendar.set(Calendar.ZONE_OFFSET, 0);
 1741                               return pos.index;
 1742                           }
 1743   
 1744                           // Look for hours.
 1745                           try {
 1746                               char c = text.charAt(++pos.index);
 1747                               if (c < '0' || c > '9') { /* must be from '0' to '9'. */
 1748                                   break parsing;
 1749                               }
 1750                               num = c - '0';
 1751   
 1752                               if (text.charAt(++pos.index) != ':') {
 1753                                   c = text.charAt(pos.index);
 1754                                   if (c < '0' || c > '9') { /* must be from '0' to '9'. */
 1755                                       break parsing;
 1756                                   }
 1757                                   num *= 10;
 1758                                   num += c - '0';
 1759                                   pos.index++;
 1760                               }
 1761                               if (num > 23) {
 1762                                   --pos.index;
 1763                                   break parsing;
 1764                               }
 1765                               if  (text.charAt(pos.index) != ':') {
 1766                                   break parsing;
 1767                               }
 1768   
 1769                               // Look for minutes.
 1770                               offset = num * 60;
 1771                               c = text.charAt(++pos.index);
 1772                               if (c < '0' || c > '9') { /* must be from '0' to '9'. */
 1773                                   break parsing;
 1774                               }
 1775                               num = c - '0';
 1776                               c = text.charAt(++pos.index);
 1777                               if (c < '0' || c > '9') { /* must be from '0' to '9'. */
 1778                                   break parsing;
 1779                               }
 1780                               num *= 10;
 1781                               num += c - '0';
 1782   
 1783                               if (num > 59) {
 1784                                   break parsing;
 1785                               }
 1786                           } catch (StringIndexOutOfBoundsException e) {
 1787                               break parsing;
 1788                           }
 1789                           offset += num;
 1790                           // Fall through for final processing below of 'offset' and 'sign'.
 1791                       } else {
 1792                           // If the first character is a sign, look for numeric timezones of
 1793                           // the form [+-]hhmm as specified by RFC 822. Otherwise, check
 1794                           // for named time zones by looking through the locale data from
 1795                           // the TimeZoneNames strings.
 1796                           try {
 1797                               char c = text.charAt(pos.index);
 1798                               if (c == '+') {
 1799                                   sign = 1;
 1800                               } else if (c == '-') {
 1801                                   sign = -1;
 1802                               } else {
 1803                                   // Try parsing the text as a time zone name (abbr).
 1804                                   int i = subParseZoneString(text, pos.index);
 1805                                   if (i != 0) {
 1806                                       return i;
 1807                                   }
 1808                                   break parsing;
 1809                               }
 1810   
 1811                               // Parse the text as an RFC 822 time zone string. This code is
 1812                               // actually a little more permissive than RFC 822.  It will
 1813                               // try to do its best with numbers that aren't strictly 4
 1814                               // digits long.
 1815   
 1816                               // Look for hh.
 1817                               int hours = 0;
 1818                               c = text.charAt(++pos.index);
 1819                               if (c < '0' || c > '9') { /* must be from '0' to '9'. */
 1820                                   break parsing;
 1821                               }
 1822                               hours = c - '0';
 1823                               c = text.charAt(++pos.index);
 1824                               if (c < '0' || c > '9') { /* must be from '0' to '9'. */
 1825                                   break parsing;
 1826                               }
 1827                               hours *= 10;
 1828                               hours += c - '0';
 1829   
 1830                               if (hours > 23) {
 1831                                   break parsing;
 1832                               }
 1833   
 1834                               // Look for mm.
 1835                               int minutes = 0;
 1836                               c = text.charAt(++pos.index);
 1837                               if (c < '0' || c > '9') { /* must be from '0' to '9'. */
 1838                                   break parsing;
 1839                               }
 1840                               minutes = c - '0';
 1841                               c = text.charAt(++pos.index);
 1842                               if (c < '0' || c > '9') { /* must be from '0' to '9'. */
 1843                                   break parsing;
 1844                               }
 1845                               minutes *= 10;
 1846                               minutes += c - '0';
 1847   
 1848                               if (minutes > 59) {
 1849                                   break parsing;
 1850                               }
 1851   
 1852                               offset = hours * 60 + minutes;
 1853                           } catch (StringIndexOutOfBoundsException e) {
 1854                               break parsing;
 1855                           }
 1856                       }
 1857   
 1858                       // Do the final processing for both of the above cases.  We only
 1859                       // arrive here if the form GMT+/-... or an RFC 822 form was seen.
 1860                       if (sign != 0) {
 1861                           offset *= MILLIS_PER_MINUTE * sign;
 1862                           calendar.set(Calendar.ZONE_OFFSET, offset);
 1863                           calendar.set(Calendar.DST_OFFSET, 0);
 1864                           return ++pos.index;
 1865                       }
 1866                   }
 1867                   break parsing;
 1868   
 1869               default:
 1870                   // case 3: // 'd' - DATE
 1871                   // case 5: // 'H' - HOUR_OF_DAY:0-based.  eg, 23:59 + 1 hour =>> 00:59
 1872                   // case 6: // 'm' - MINUTE
 1873                   // case 7: // 's' - SECOND
 1874                   // case 8: // 'S' - MILLISECOND
 1875                   // case 10: // 'D' - DAY_OF_YEAR
 1876                   // case 11: // 'F' - DAY_OF_WEEK_IN_MONTH
 1877                   // case 12: // 'w' - WEEK_OF_YEAR
 1878                   // case 13: // 'W' - WEEK_OF_MONTH
 1879                   // case 16: // 'K' - HOUR: 0-based.  eg, 11PM + 1 hour =>> 0 AM
 1880   
 1881                   // Handle "generic" fields
 1882                   if (obeyCount) {
 1883                       if ((start+count) > text.length()) {
 1884                           break parsing;
 1885                       }
 1886                       number = numberFormat.parse(text.substring(0, start+count), pos);
 1887                   } else {
 1888                       number = numberFormat.parse(text, pos);
 1889                   }
 1890                   if (number != null) {
 1891                       calendar.set(field, number.intValue());
 1892                       return pos.index;
 1893                   }
 1894                   break parsing;
 1895               }
 1896           }
 1897   
 1898           // Parsing failed.
 1899           origPos.errorIndex = pos.index;
 1900           return -1;
 1901       }
 1902   
 1903       private final String getCalendarName() {
 1904           return calendar.getClass().getName();
 1905       }
 1906   
 1907       private boolean useDateFormatSymbols() {
 1908           if (useDateFormatSymbols) {
 1909               return true;
 1910           }
 1911           return isGregorianCalendar() || locale == null;
 1912       }
 1913   
 1914       private boolean isGregorianCalendar() {
 1915           return "java.util.GregorianCalendar".equals(getCalendarName());
 1916       }
 1917   
 1918       /**
 1919        * Translates a pattern, mapping each character in the from string to the
 1920        * corresponding character in the to string.
 1921        *
 1922        * @exception IllegalArgumentException if the given pattern is invalid
 1923        */
 1924       private String translatePattern(String pattern, String from, String to) {
 1925           StringBuilder result = new StringBuilder();
 1926           boolean inQuote = false;
 1927           for (int i = 0; i < pattern.length(); ++i) {
 1928               char c = pattern.charAt(i);
 1929               if (inQuote) {
 1930                   if (c == '\'')
 1931                       inQuote = false;
 1932               }
 1933               else {
 1934                   if (c == '\'')
 1935                       inQuote = true;
 1936                   else if ((c >= 'a' && c <= 'z') || (c >= 'A' && c <= 'Z')) {
 1937                       int ci = from.indexOf(c);
 1938                       if (ci == -1)
 1939                           throw new IllegalArgumentException("Illegal pattern " +
 1940                                                              " character '" +
 1941                                                              c + "'");
 1942                       c = to.charAt(ci);
 1943                   }
 1944               }
 1945               result.append(c);
 1946           }
 1947           if (inQuote)
 1948               throw new IllegalArgumentException("Unfinished quote in pattern");
 1949           return result.toString();
 1950       }
 1951   
 1952       /**
 1953        * Returns a pattern string describing this date format.
 1954        *
 1955        * @return a pattern string describing this date format.
 1956        */
 1957       public String toPattern() {
 1958           return pattern;
 1959       }
 1960   
 1961       /**
 1962        * Returns a localized pattern string describing this date format.
 1963        *
 1964        * @return a localized pattern string describing this date format.
 1965        */
 1966       public String toLocalizedPattern() {
 1967           return translatePattern(pattern,
 1968                                   DateFormatSymbols.patternChars,
 1969                                   formatData.getLocalPatternChars());
 1970       }
 1971   
 1972       /**
 1973        * Applies the given pattern string to this date format.
 1974        *
 1975        * @param pattern the new date and time pattern for this date format
 1976        * @exception NullPointerException if the given pattern is null
 1977        * @exception IllegalArgumentException if the given pattern is invalid
 1978        */
 1979       public void applyPattern (String pattern)
 1980       {
 1981           compiledPattern = compile(pattern);
 1982           this.pattern = pattern;
 1983       }
 1984   
 1985       /**
 1986        * Applies the given localized pattern string to this date format.
 1987        *
 1988        * @param pattern a String to be mapped to the new date and time format
 1989        *        pattern for this format
 1990        * @exception NullPointerException if the given pattern is null
 1991        * @exception IllegalArgumentException if the given pattern is invalid
 1992        */
 1993       public void applyLocalizedPattern(String pattern) {
 1994            String p = translatePattern(pattern,
 1995                                        formatData.getLocalPatternChars(),
 1996                                        DateFormatSymbols.patternChars);
 1997            compiledPattern = compile(p);
 1998            this.pattern = p;
 1999       }
 2000   
 2001       /**
 2002        * Gets a copy of the date and time format symbols of this date format.
 2003        *
 2004        * @return the date and time format symbols of this date format
 2005        * @see #setDateFormatSymbols
 2006        */
 2007       public DateFormatSymbols getDateFormatSymbols()
 2008       {
 2009           return (DateFormatSymbols)formatData.clone();
 2010       }
 2011   
 2012       /**
 2013        * Sets the date and time format symbols of this date format.
 2014        *
 2015        * @param newFormatSymbols the new date and time format symbols
 2016        * @exception NullPointerException if the given newFormatSymbols is null
 2017        * @see #getDateFormatSymbols
 2018        */
 2019       public void setDateFormatSymbols(DateFormatSymbols newFormatSymbols)
 2020       {
 2021           this.formatData = (DateFormatSymbols)newFormatSymbols.clone();
 2022           useDateFormatSymbols = true;
 2023       }
 2024   
 2025       /**
 2026        * Creates a copy of this <code>SimpleDateFormat</code>. This also
 2027        * clones the format's date format symbols.
 2028        *
 2029        * @return a clone of this <code>SimpleDateFormat</code>
 2030        */
 2031       public Object clone() {
 2032           SimpleDateFormat other = (SimpleDateFormat) super.clone();
 2033           other.formatData = (DateFormatSymbols) formatData.clone();
 2034           return other;
 2035       }
 2036   
 2037       /**
 2038        * Returns the hash code value for this <code>SimpleDateFormat</code> object.
 2039        *
 2040        * @return the hash code value for this <code>SimpleDateFormat</code> object.
 2041        */
 2042       public int hashCode()
 2043       {
 2044           return pattern.hashCode();
 2045           // just enough fields for a reasonable distribution
 2046       }
 2047   
 2048       /**
 2049        * Compares the given object with this <code>SimpleDateFormat</code> for
 2050        * equality.
 2051        *
 2052        * @return true if the given object is equal to this
 2053        * <code>SimpleDateFormat</code>
 2054        */
 2055       public boolean equals(Object obj)
 2056       {
 2057           if (!super.equals(obj)) return false; // super does class check
 2058           SimpleDateFormat that = (SimpleDateFormat) obj;
 2059           return (pattern.equals(that.pattern)
 2060                   && formatData.equals(that.formatData));
 2061       }
 2062   
 2063       /**
 2064        * After reading an object from the input stream, the format
 2065        * pattern in the object is verified.
 2066        * <p>
 2067        * @exception InvalidObjectException if the pattern is invalid
 2068        */
 2069       private void readObject(ObjectInputStream stream)
 2070                            throws IOException, ClassNotFoundException {
 2071           stream.defaultReadObject();
 2072   
 2073           try {
 2074               compiledPattern = compile(pattern);
 2075           } catch (Exception e) {
 2076               throw new InvalidObjectException("invalid pattern");
 2077           }
 2078   
 2079           if (serialVersionOnStream < 1) {
 2080               // didn't have defaultCenturyStart field
 2081               initializeDefaultCentury();
 2082           }
 2083           else {
 2084               // fill in dependent transient field
 2085               parseAmbiguousDatesAsAfter(defaultCenturyStart);
 2086           }
 2087           serialVersionOnStream = currentSerialVersion;
 2088   
 2089           // If the deserialized object has a SimpleTimeZone, try
 2090           // to replace it with a ZoneInfo equivalent in order to
 2091           // be compatible with the SimpleTimeZone-based
 2092           // implementation as much as possible.
 2093           TimeZone tz = getTimeZone();
 2094           if (tz instanceof SimpleTimeZone) {
 2095               String id = tz.getID();
 2096               TimeZone zi = TimeZone.getTimeZone(id);
 2097               if (zi != null && zi.hasSameRules(tz) && zi.getID().equals(id)) {
 2098                   setTimeZone(zi);
 2099               }
 2100           }
 2101       }
 2102   }
