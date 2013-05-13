<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 5/1/13
 * @version 1.0.0
 */

namespace FDevs\ArticleBundle\DataFixtures;


class LoremIpsum
{
    /**
     * @var array
     */
    private static $lorem = array(
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam nec mi a lectus auctor laoreet nec vel elit. Praesent nec velit nec nunc mollis tincidunt. Praesent quis neque tortor. Pellentesque egestas suscipit purus quis viverra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi lacus enim, malesuada quis varius eu, faucibus vitae tellus. Curabitur neque purus, venenatis ac egestas vel, varius non lorem. Nam mauris est, rutrum vitae posuere et, egestas quis arcu.',
        'Aliquam sagittis ullamcorper diam vel faucibus. Suspendisse ante purus, iaculis in dignissim sed, lobortis eget mauris. Duis orci massa, faucibus ac malesuada scelerisque, ultrices ac eros. Sed ut lectus libero, sit amet gravida orci. Quisque venenatis lacus sit amet orci faucibus convallis. Cras ac neque quis eros sollicitudin placerat eget in lacus. Etiam id mauris diam. In vel metus eu quam fringilla ultricies a ut magna. Mauris tempor magna viverra urna mollis quis tincidunt libero imperdiet. Curabitur eget justo nec nibh dapibus iaculis. Suspendisse eleifend, elit ut pretium sollicitudin, sem est iaculis metus, id cursus nulla est sit amet ipsum. Nunc odio elit, sollicitudin quis pulvinar semper, rhoncus eget velit. Ut blandit erat nec sem tempor id eleifend elit pellentesque. Donec sed massa quam, sed consectetur lectus. Aenean feugiat posuere tempus. Curabitur scelerisque malesuada sodales.',
        'Etiam nec augue id lectus porttitor vehicula id molestie nulla. Aenean pellentesque accumsan enim nec varius. Duis volutpat sodales rutrum. Fusce hendrerit lacus ac sem adipiscing non venenatis lorem scelerisque. Donec consectetur nulla massa. Nunc mattis, elit in auctor lacinia, sem lorem dapibus dui, vel posuere tellus dolor ac erat. Vestibulum euismod, magna eget egestas vehicula, metus nisl tempor ante, id porta odio lorem at magna. Proin in est magna. Vivamus fringilla, felis et posuere fringilla, mi est iaculis elit, in pretium leo velit vitae felis. Quisque ligula sapien, dapibus a cursus quis, adipiscing sed lacus.',
        'Mauris tempor, nisl fringilla faucibus vehicula, purus tellus cursus leo, aliquam sodales felis quam ut nibh. Phasellus lacinia eleifend molestie. Donec fringilla, mi viverra pharetra fermentum, leo velit egestas ante, eget lobortis eros purus ultrices felis. Maecenas sed mauris ipsum, in mollis velit. Aliquam erat volutpat. Cras a urna eu dui dictum suscipit at ac nibh. Phasellus non lectus dolor. Quisque a neque sit amet erat dapibus gravida. Vivamus vulputate dapibus mauris, vel luctus purus pellentesque eu. Quisque vulputate, felis vulputate luctus vehicula, quam nunc volutpat nibh, quis semper quam erat vitae elit. Nam tristique lacinia arcu id pulvinar. Duis porta tempus aliquam. Praesent elit tellus, suscipit quis mattis vel, consequat aliquet magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis dapibus gravida mauris, vel sodales elit gravida nec.',
        'Donec at arcu sem, a faucibus risus. Nam dictum, nisl a consectetur imperdiet, metus erat faucibus sapien, quis tempor nibh dui eget eros. Duis interdum, enim sed tempus congue, risus elit ultrices elit, quis porttitor arcu risus quis nunc. Cras tellus metus, tristique vel placerat nec, convallis a diam. Nunc placerat euismod vestibulum. Fusce ut feugiat ante. Cras vestibulum auctor dolor in commodo. Sed rutrum mauris at augue ullamcorper non commodo justo lacinia. Vivamus orci nisl, auctor non eleifend id, lacinia vel mi.',
        'Duis purus lorem, sollicitudin id volutpat nec, pulvinar ac ipsum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed vehicula nulla non magna porttitor faucibus. In vestibulum congue blandit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce a urna vel felis blandit imperdiet. Vestibulum semper convallis nisi, et sagittis purus aliquet vel. Etiam sollicitudin pulvinar libero, ac ornare nulla malesuada non. Nunc nec odio ac eros semper auctor. Aenean sit amet diam ut metus elementum placerat quis a ante. Suspendisse sed nibh lectus, ac faucibus diam.',
        'Nam velit turpis, ornare vitae dignissim non, mattis et orci. Maecenas mi diam, placerat ut venenatis vitae, posuere in eros. Proin in erat et mi vehicula scelerisque vitae vel augue. Suspendisse potenti. Mauris fringilla facilisis turpis, sit amet varius nisi semper non. Donec nec orci quis justo convallis volutpat nec non mauris. Ut pharetra convallis tortor non pulvinar. Sed non risus ante. Integer malesuada scelerisque quam eu cursus.',
        'Aliquam non purus ligula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris semper ullamcorper est, eu consectetur tellus volutpat vitae. Aenean lobortis urna id massa pretium sit amet vulputate nisi vulputate. Fusce at diam orci. Aliquam eu nulla ut neque ornare convallis. Aliquam tortor justo, faucibus at molestie id, condimentum non erat. Fusce porta, est a consequat sollicitudin, magna lectus fermentum lectus, molestie ornare felis turpis nec metus. Praesent ornare, mauris non tempus aliquam, est ligula ornare nulla, sed commodo dolor diam eget eros. Vivamus rhoncus tellus id ipsum aliquet ac convallis nisi commodo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;',
        'Integer odio mi, malesuada et blandit ut, feugiat id ipsum. Suspendisse ultrices mauris ac mauris pulvinar porttitor. Nullam a metus in nisl posuere eleifend sed sit amet tortor. Cras in orci quam, eu molestie erat. Donec dictum rutrum consequat. Maecenas placerat augue sed sapien molestie ac accumsan leo commodo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla rutrum nibh eu lorem luctus quis ultrices ligula mattis. Nunc vel placerat est.',
        'Sed sit amet purus enim, tincidunt aliquet neque. In tristique dolor sit amet quam gravida tempus. Proin posuere ultrices elit sed feugiat. Nulla tristique placerat augue, in faucibus ante tincidunt at. Nam velit est, laoreet ut dictum et, molestie quis nibh. Fusce nisi purus, auctor a volutpat ac, imperdiet ut dui. Donec erat purus, molestie eu accumsan accumsan, porttitor in velit. Mauris sem felis, pulvinar et aliquam id, pellentesque id leo.',
        'Nullam gravida justo in nulla cursus varius. Ut felis nisi, fermentum sit amet vestibulum at, luctus at lorem. Morbi eget elit ut dui lacinia euismod. Vivamus ut odio lorem, non ullamcorper nisi. Quisque est mi, venenatis vulputate mattis vitae, aliquam venenatis lacus. Suspendisse feugiat consequat tempor. In hac habitasse platea dictumst. Integer tempor arcu in purus pulvinar feugiat.',
        'Suspendisse interdum facilisis tortor, vel imperdiet quam mollis ut. Proin ultricies enim et mi ultricies iaculis. Nunc enim diam, posuere et tincidunt pulvinar, pulvinar non orci. Ut nec tortor metus. Cras imperdiet sem nec turpis rutrum a ultrices augue scelerisque. Maecenas porttitor scelerisque tellus, eget congue lectus pretium nec. Nullam feugiat porta velit, vitae ultrices neque facilisis non. Proin eu ligula ut sem imperdiet dignissim. Aenean ut nunc ligula. Donec varius porttitor quam sit amet viverra.',
        'Aliquam ut est in arcu gravida malesuada. Nulla id tortor risus, quis convallis ante. Aliquam adipiscing porta erat id auctor. Nunc sed metus non odio dictum vulputate a a felis. Integer posuere bibendum sagittis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum dolor lorem, placerat ut feugiat eget, suscipit sit amet velit. Duis vulputate, purus a fermentum adipiscing, risus est pharetra augue, vitae tempor erat tortor vel lacus. Ut volutpat tincidunt diam non dapibus. Nullam in lorem lectus, ut fermentum enim. Morbi ut est nunc. Integer volutpat consectetur libero ut pellentesque. Curabitur justo risus, sollicitudin et pellentesque sed, elementum at odio.',
        'Aenean felis dui, rhoncus a cursus in, congue sit amet felis. Ut semper tristique mi ac ornare. Pellentesque et imperdiet magna. Proin dictum viverra dui, sit amet commodo justo tincidunt vel. Vestibulum suscipit lectus et purus molestie consectetur. Integer vulputate ante vel lacus dignissim eu pellentesque metus fermentum. Maecenas venenatis aliquam arcu sit amet consequat. Vestibulum eu ligula magna, quis placerat urna. Sed metus mauris, lacinia nec tristique eget, porta ut enim. Sed velit purus, semper commodo eleifend sit amet, iaculis ut dui.',
        'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        'Nam elementum, mauris pulvinar cursus blandit, augue orci vehicula lacus, a rhoncus sapien lacus et diam. Fusce non sem quam. Aliquam lorem tellus, accumsan ac fringilla sit amet, ultricies non lacus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse potenti. Donec lacinia mi eget orci varius at vestibulum purus pharetra. Aliquam pretium interdum tempor. Morbi tristique ullamcorper turpis, in tempus augue elementum vel. Quisque sit amet ante id odio mollis accumsan. Nulla lacinia fermentum leo, quis accumsan velit vulputate sed. Donec sed libero ante. Cras turpis enim, varius hendrerit tempor sit amet, vestibulum et eros. Cras id tincidunt eros. Phasellus lorem velit, interdum vitae scelerisque in, rhoncus eget urna. Curabitur ut bibendum nisi. Phasellus facilisis, nisi tempor scelerisque auctor, erat erat lacinia elit, eget condimentum augue nunc nec mi.',
        'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec non aliquet diam. Donec mollis vulputate justo, quis scelerisque ante commodo at. Aliquam eu metus purus. Fusce dui enim, egestas auctor imperdiet porttitor, cursus non tortor. Morbi purus magna, viverra quis consectetur eget, faucibus eu risus. Nulla facilisi. Integer est mauris, condimentum a luctus non, tincidunt nec tellus. Quisque vulputate est nec felis convallis eu eleifend metus porttitor. Fusce interdum viverra libero id commodo. Aliquam in magna vitae lacus fermentum ultrices. Pellentesque molestie mollis nisi, sed commodo diam fermentum vel. Etiam a massa risus, id lobortis diam. Etiam vehicula est auctor odio rhoncus sed tempor augue tristique.',
        'Quisque nisl elit, laoreet at accumsan in, hendrerit et eros. Ut a imperdiet ligula. Morbi vehicula posuere consectetur. Donec ultrices mattis vehicula. Donec auctor lacinia condimentum. Vivamus felis mi, consequat sit amet varius quis, eleifend vitae est. Nulla leo elit, condimentum non lacinia id, eleifend eu purus. Mauris rhoncus luctus magna, in placerat libero fermentum nec. Donec odio erat, vulputate quis posuere et, aliquet sed lacus. Sed dictum sem at est tincidunt dignissim. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam sollicitudin consequat vulputate. Vestibulum consequat, ipsum in fringilla lacinia, velit sem congue magna, eget aliquam diam nunc et purus. Praesent interdum rhoncus erat id porta. Donec vel nulla nec magna condimentum bibendum sit amet congue diam.',
        'Nulla facilisi. Aliquam hendrerit blandit mauris id auctor. In hac habitasse platea dictumst. Vestibulum luctus lorem eu est lacinia volutpat. Fusce lobortis eros et nisi fringilla eget dignissim elit vestibulum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut lectus et diam congue volutpat. Sed ac mauris quam, eget placerat dui. Nulla suscipit, odio eu eleifend interdum, nisl risus imperdiet mauris, ut facilisis mi odio ut ipsum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed erat a turpis consequat imperdiet. Pellentesque massa turpis, rutrum nec bibendum sed, dignissim sit amet ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer eu nunc nec sapien vulputate commodo ac in orci. Vivamus mollis venenatis ornare.',
        'Aliquam nec justo ac dui aliquet vulputate sed et nisi. Quisque dapibus varius lacus id ornare. Proin placerat velit ut sapien mollis sed elementum tellus molestie. Donec odio lacus, pulvinar eget posuere vitae, dapibus in metus. Nulla consequat risus quis quam faucibus rutrum. Phasellus nec nibh diam. Pellentesque facilisis sagittis orci vel condimentum. In hac habitasse platea dictumst. In sit amet sem nec nisl porttitor condimentum eu eget erat. Donec nisi dolor, commodo ultricies suscipit vel, lobortis quis justo. Fusce ipsum nunc, malesuada id faucibus sed, fermentum nec augue. Nullam vel consequat elit. Phasellus aliquam nunc in felis egestas varius. Aenean at orci justo.',
        'Proin gravida pharetra sodales. Morbi imperdiet, elit eu cursus ullamcorper, orci metus volutpat est, at fermentum orci enim ac enim. Proin lobortis accumsan est, id pretium nunc placerat vel. Proin id eros vel justo porta bibendum ut vitae neque. Quisque dolor tellus, tincidunt non vestibulum eget, luctus pellentesque orci. Nullam aliquam neque ut purus faucibus in cursus metus malesuada. Sed dapibus lorem a nisi feugiat lacinia. Donec molestie facilisis orci, rhoncus placerat massa ultrices a. Mauris id adipiscing odio. Duis sed metus dui. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nam nec sem ac quam rhoncus laoreet. Praesent sed felis et nunc pharetra tempus id sit amet nisl. Proin nisl elit, dignissim ut facilisis quis, condimentum et lectus.',
        'Nunc in ullamcorper augue. Donec hendrerit, est nec feugiat bibendum, odio nisl ultricies urna, sed rhoncus lacus justo eu enim. Aliquam erat volutpat. Sed eu faucibus nisl. Morbi tincidunt ipsum eget neque ullamcorper adipiscing tempus tortor pellentesque. Maecenas ornare eleifend sapien. Donec consectetur porttitor dui, nec condimentum dui tempor et. Ut feugiat condimentum hendrerit. Morbi semper faucibus dignissim.',
        'Nunc non dolor eget nibh hendrerit dignissim id at orci. Nam nulla orci, lobortis ac egestas sit amet, congue non mauris. Aliquam id libero et nibh tincidunt gravida nec sit amet nunc. Nulla vel nisl et nisl vehicula consequat eget a sapien. Vestibulum tempor molestie erat, id aliquam quam aliquet vel. Morbi luctus sollicitudin aliquam. Proin id eros nibh. Suspendisse fringilla, magna vitae porttitor ornare, nisl neque tristique est, sed placerat lacus leo eu lacus. Donec ultrices porta nisi quis gravida. Maecenas metus sem, consequat nec sollicitudin nec, lacinia eget lorem. Fusce mauris enim, sodales non eleifend semper, dictum accumsan nibh. Nunc blandit lobortis urna, sed varius libero dapibus et.',
        'Proin libero libero, feugiat in ultricies et, fringilla vel mi. In mollis velit eu mauris consequat ac consequat mi eleifend. Nulla facilisi. Ut eget urna sed elit lacinia pharetra. In hac habitasse platea dictumst. Cras sit amet elit purus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum ac dui dolor. Duis ac hendrerit quam. Phasellus mattis velit sed tortor interdum porta. Pellentesque eleifend, libero quis accumsan tincidunt, purus nisi porta ante, sit amet rutrum nibh turpis sit amet orci. Nulla congue auctor convallis.',
        'Nulla tincidunt elementum erat, non ornare sem lobortis sit amet. Nullam augue neque, dignissim eu viverra ut, egestas in tellus. Etiam et augue dui. Vivamus vestibulum aliquet felis vitae vulputate. Vestibulum tincidunt ante at tellus pharetra eget tempus leo fringilla. Vivamus facilisis orci ut sem interdum congue. Ut imperdiet tincidunt neque in volutpat.',
        'Nulla eleifend nisl ligula. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin placerat dapibus justo, id adipiscing orci egestas nec. Duis id tellus tortor. Nulla faucibus dui id elit gravida semper. Maecenas consectetur elit ac risus porttitor sollicitudin hendrerit dolor vehicula. Ut non metus et lacus consectetur molestie eu dictum est.',
        'Pellentesque gravida arcu sed lectus commodo placerat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vivamus malesuada, tortor sit amet tincidunt euismod, sem sem tincidunt lorem, id dapibus tellus risus quis nunc. Cras commodo metus nec odio pellentesque auctor. Aliquam erat volutpat. Nullam vitae enim nec justo vestibulum laoreet. Curabitur aliquam egestas laoreet.',
        'Curabitur vitae arcu libero. Integer vestibulum vulputate quam, at placerat dui tempus vitae. Etiam suscipit euismod felis eu placerat. Sed ornare, tortor non pretium porttitor, eros arcu blandit tortor, ut vulputate tortor dui sed neque. Duis magna mi, euismod sed rutrum non, luctus a nibh. Proin dapibus malesuada nunc vel rutrum. Suspendisse et arcu felis. Suspendisse magna sem, adipiscing at pulvinar in, pharetra quis sapien. Donec eget lorem sem. Morbi adipiscing sem eu lectus hendrerit vel ullamcorper massa interdum. Ut pellentesque, odio id sollicitudin mattis, urna justo interdum massa, eu volutpat nunc dolor sit amet quam. Curabitur id lacus arcu. Morbi ac est eget dolor cursus auctor a eget magna. Vivamus scelerisque, tortor id vulputate placerat, arcu lorem tempor mi, vitae fermentum justo est a massa.',
        'Vestibulum viverra volutpat ullamcorper. Vivamus in leo metus. Integer ultricies pretium diam et convallis. In pharetra ante quis lectus tempor id congue diam vehicula. Donec ut felis lorem. Mauris tincidunt accumsan mi a faucibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam molestie sollicitudin fermentum. Suspendisse potenti. Aliquam congue ipsum eget dolor sodales et tincidunt mauris luctus. Nunc volutpat dolor id tellus ornare viverra imperdiet magna blandit. Pellentesque rutrum, arcu et facilisis laoreet, dui nunc semper ante, eu ullamcorper velit leo blandit risus. Aliquam hendrerit condimentum odio, non commodo felis blandit malesuada. Vivamus diam arcu, consequat sit amet bibendum volutpat, semper nec arcu. Sed pulvinar justo pulvinar odio vehicula iaculis. Integer suscipit justo gravida orci blandit condimentum.',
        'Ut scelerisque ligula magna, faucibus varius dui. Aliquam hendrerit, tellus in sodales tincidunt, nibh erat consectetur leo, in consequat arcu mi sed dolor. Vestibulum sit amet velit eu tortor mattis scelerisque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin vel arcu mauris. Suspendisse a felis tortor, nec congue erat. Suspendisse eros magna, ultrices et vulputate ut, iaculis nec ante.',
        'Sed lacus lectus, condimentum et pulvinar ac, imperdiet et eros. Proin blandit porta posuere. Cras vel quam sit amet nunc iaculis congue at in tortor. Nulla porta diam vitae arcu eleifend interdum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque hendrerit bibendum augue, sed semper libero porta at. Maecenas iaculis, tortor aliquam adipiscing mattis, augue est varius erat, ut posuere ligula nisl sit amet ante. Morbi placerat eros sit amet ante lacinia ac placerat velit ultrices. Etiam ac magna turpis, sit amet posuere diam. Sed sed risus metus. Aliquam vitae libero non metus lobortis convallis. Phasellus lobortis velit in purus placerat quis placerat felis tempor. Vestibulum vel neque nec ante vestibulum lacinia. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam mauris turpis, dictum semper mollis in, bibendum non nunc.',
        'Aliquam mattis nulla nec orci suscipit ac consectetur nulla ullamcorper. Morbi sollicitudin aliquet nibh, sit amet vulputate diam lacinia ac. Phasellus vehicula imperdiet lorem, vestibulum rhoncus arcu commodo eu. Nullam ac urna orci. Aliquam erat volutpat. Sed eget velit urna, ut lacinia eros. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi varius sodales leo, quis dapibus felis aliquam eget. Curabitur non est odio, sed consequat neque. Suspendisse accumsan imperdiet diam quis vestibulum.',
        'Sed lectus arcu, placerat tempor dignissim sed, pellentesque id turpis. Ut congue dapibus condimentum. Sed lacinia congue dapibus. Quisque non sollicitudin justo. Sed in metus non tellus tempor auctor nec at odio. Quisque gravida, risus facilisis scelerisque placerat, nulla ligula aliquet erat, ut iaculis lectus felis non metus. Morbi ut tincidunt dui. Ut sollicitudin dui eu libero imperdiet ut dignissim quam condimentum.',
        'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.',
        'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.',
        'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',
        'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.',
        'Fusce sem odio, pretium id rutrum nec, egestas id felis. Etiam pharetra scelerisque justo, vitae malesuada mauris volutpat a. Suspendisse quis arcu eu turpis rutrum pretium. In suscipit bibendum tincidunt. Maecenas quis quam purus, vitae condimentum augue. Aliquam euismod mollis augue, eu mattis purus auctor id. Sed congue luctus elementum. Suspendisse potenti. In at nisl urna. Fusce a diam justo, at tempus dolor. Quisque pellentesque mi consectetur erat ullamcorper tristique in at elit.',
        'Aenean ipsum sapien, pulvinar vel vulputate a, pellentesque vel dolor. In nec luctus enim. Duis porttitor tristique velit ac dictum. Nunc et felis justo, eu laoreet nibh. Fusce in mauris eu dui suscipit elementum vel nec augue. Sed pretium lectus in ante pellentesque pretium. Phasellus lacinia dolor eget dolor ultricies ut ultricies velit euismod. Aenean eu mi vitae purus varius consectetur sed sit amet nunc. Donec at metus a leo varius porta. Nulla egestas, sapien nec iaculis consequat, est metus congue elit, et pellentesque elit libero quis lectus. Sed ut nisl nibh, et tristique risus. Nullam volutpat nibh eget turpis luctus porta vulputate neque pellentesque. Maecenas diam metus, pharetra ac consectetur quis, dapibus vitae mauris. Praesent non lacus quis ipsum elementum luctus non imperdiet neque.',
        'Cras sem enim, accumsan vel ultrices id, viverra porta magna. Sed placerat suscipit aliquam. Duis dignissim aliquam ultricies. Mauris consectetur ornare tincidunt. Nulla porttitor est id nisl tempor vehicula placerat nunc placerat. Donec auctor tortor non nibh gravida ut elementum est ultrices. Etiam felis dolor, convallis nec semper sit amet, fringilla at ipsum. Nam malesuada, lacus vel condimentum accumsan, sapien purus vulputate tortor, id fermentum purus felis sed quam.',
        'Vestibulum consectetur volutpat nibh, porta elementum velit luctus ut. Donec eget faucibus nulla. Phasellus id arcu sit amet nunc rutrum gravida nec a tortor. Vestibulum enim magna, hendrerit et mollis eu, malesuada sed ipsum. Phasellus luctus egestas metus in adipiscing. In hac habitasse platea dictumst. Duis neque odio, tempor sed vestibulum nec, convallis ac tellus. Nullam sagittis tellus et diam elementum rutrum in sit amet turpis. Vivamus tempus vulputate orci, sit amet molestie risus ultrices ac. Ut rhoncus ultrices lacus, eget malesuada lorem eleifend ut. Aenean non luctus felis. Pellentesque cursus accumsan urna, id auctor leo tincidunt vel. Etiam facilisis, enim at tincidunt congue, ipsum lorem imperdiet leo, vitae congue leo augue et lectus. Vestibulum consectetur cursus adipiscing. Maecenas non nunc ut mauris tempus suscipit.',
        'Fusce sem neque, ullamcorper in sollicitudin a, tincidunt non odio. Fusce cursus massa a elit laoreet vestibulum. Sed at eros erat, id luctus nisi. Curabitur placerat orci id nulla tempus nec hendrerit dolor ornare. Nam tempus augue quis nulla varius aliquet. Aliquam vestibulum risus id arcu cursus sed vulputate mi lacinia. Nulla facilisi. Quisque sed diam a massa tristique pretium non quis arcu. Integer risus sem, luctus a convallis ac, tempus quis est. Aenean condimentum elementum lorem cursus ornare. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut tempor velit sit amet justo scelerisque fermentum venenatis tortor mattis. Etiam tortor enim, viverra ac egestas vel, gravida quis libero. Sed placerat, risus sit amet elementum dapibus, mauris lorem tempor libero, eu pellentesque tellus nunc semper quam.',
        'Maecenas sit amet sapien tellus. Aenean vehicula, ante sit amet pharetra venenatis, nulla massa elementum risus, sagittis aliquet quam dolor accumsan erat. Sed arcu odio, suscipit non consectetur et, pharetra ut tellus. Nam erat mauris, tempus eu gravida ac, dignissim non magna. Curabitur tempus convallis massa lobortis interdum. Pellentesque eget ultrices urna. Donec interdum dignissim adipiscing.',
        'Morbi id lacus dolor. Sed iaculis, purus ut sagittis feugiat, lorem lacus mattis nulla, at rhoncus justo lacus in elit. Quisque convallis ultrices metus ac rutrum. Nam sit amet ante vitae ante adipiscing viverra. Praesent id eleifend purus. Suspendisse potenti. Quisque sed dapibus justo. Praesent imperdiet, justo et porttitor auctor, arcu nisi ornare lectus, in aliquam risus erat nec lectus.',
        'Maecenas nulla sem, faucibus a vestibulum sit amet, ullamcorper dapibus nunc. Proin nec ligula non urna ornare mollis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer placerat, augue quis pretium imperdiet, erat eros malesuada lorem, sit amet lobortis mauris sapien sed magna. Pellentesque et quam massa. Praesent eu ornare risus. Mauris convallis velit non libero aliquet gravida. Nunc in dolor sit amet erat scelerisque ullamcorper. Donec bibendum nisi ut lorem accumsan adipiscing non in tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla semper, risus at ullamcorper commodo, tellus eros consequat libero, in faucibus augue lectus ac nisi. Morbi vel nulla non justo tristique sodales. Nulla non arcu risus, tristique venenatis massa. Donec cursus felis id turpis tempor pulvinar. Quisque id sem congue sapien congue blandit id id tortor.',
        'Aliquam vitae lacus arcu. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin non tempor augue. Donec bibendum mattis quam, nec fringilla velit convallis in. Quisque tempus gravida porttitor. Vestibulum et orci felis, quis congue sem. Nullam tincidunt leo quis dui imperdiet ac laoreet metus volutpat. Proin dapibus libero a massa blandit vel condimentum orci commodo. Morbi vel porta enim. Aliquam bibendum, libero a condimentum interdum, neque leo bibendum nisi, ac pharetra justo lectus at eros. Phasellus nec fringilla eros. Phasellus mauris lacus, lobortis ac pharetra nec, ultrices sit amet quam.',
        'Sed porttitor faucibus auctor. Nam commodo imperdiet leo at scelerisque. Nullam auctor placerat dolor, vitae consequat dui ultricies vitae. In hac habitasse platea dictumst. Mauris consequat auctor sem nec vehicula. Cras condimentum est quis orci commodo ullamcorper. Vivamus a sem elit. Cras gravida ultricies urna non blandit. In vel dolor arcu, nec interdum odio. Phasellus rutrum nunc ut enim vestibulum pretium. Integer rutrum ante vitae risus molestie eu lacinia nisl rhoncus. In porta, sapien non faucibus molestie, metus tortor lacinia lorem, sed vestibulum leo sem sit amet leo.',
        'Donec pharetra posuere odio, ut egestas purus luctus sed. Donec vulputate ligula in sapien euismod nec lacinia sapien eleifend. Etiam sed nisl turpis, gravida sodales nunc. Fusce lacinia tincidunt ornare. Nam id pharetra ante. Praesent malesuada pretium mauris ac elementum. Ut scelerisque, enim vitae ultrices pharetra, lorem diam varius sapien, non viverra sem nulla vitae tortor.',
        'Duis porttitor pharetra justo sed accumsan. Pellentesque bibendum luctus lectus, placerat sollicitudin tellus pharetra ac. Suspendisse at dui augue, nec convallis felis. Pellentesque malesuada lacus id nunc tincidunt vel fermentum justo ullamcorper. Integer pulvinar libero ut nunc blandit ullamcorper. Donec dui nisi, lacinia sit amet interdum eu, blandit et justo. Praesent rutrum, sapien id tristique ullamcorper, magna tellus auctor justo, at mattis leo erat quis lorem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam tristique sollicitudin quam, nec tincidunt justo convallis eget. Etiam id ante quis ipsum gravida porttitor. Sed varius massa vel neque dictum in scelerisque velit gravida. Vivamus vehicula, dolor ac egestas blandit, justo elit blandit massa, vitae ultrices nulla metus vel nisi. Donec accumsan, ligula in vestibulum commodo, magna eros porta nunc, eu pretium lacus sem eu enim.',
        'Aenean ligula purus, mattis sed facilisis vel, scelerisque vel eros. Sed velit libero, gravida eget vulputate sit amet, consectetur quis justo. Pellentesque turpis metus, euismod eget porttitor quis, semper in urna. Maecenas ac felis a dolor pharetra elementum accumsan eu neque. Nam sed arcu sapien. Pellentesque non quam risus. Fusce vel dui nisi, sit amet gravida metus. Pellentesque varius nisl rhoncus ipsum aliquet vel pulvinar risus fringilla. Nam cursus nisi eu velit scelerisque vitae ornare neque sollicitudin. Etiam lobortis libero in est ullamcorper adipiscing. Nulla ultrices, velit ut sodales fermentum, metus mauris semper urna, sit amet pulvinar elit diam sit amet tellus. Integer et nisi quis nibh suscipit tempor id suscipit nunc. Praesent lacinia erat eget velit convallis id congue velit ornare. Vestibulum eleifend consectetur consectetur. Mauris eget mauris quis risus vehicula rhoncus eu quis arcu.',
        'In in est neque, vel lacinia mi. Vestibulum consectetur risus ultrices urna rutrum at sollicitudin eros congue. Aliquam vel tristique urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque nisi nibh, pharetra porttitor convallis ac, commodo a nulla. Praesent a nisl est, vel eleifend enim. Integer eu augue id felis placerat consequat vitae non arcu.',
        'Vivamus vel urna eu urna gravida ullamcorper. Sed dignissim tempor eros id venenatis. Quisque eu metus non ante porta vestibulum in sed ligula. Fusce pellentesque nulla eu felis vehicula tincidunt. Donec quis massa id lacus eleifend aliquet. Aenean elementum, augue et ullamcorper posuere, augue augue congue lacus, a commodo elit lacus non urna. Suspendisse velit eros, facilisis quis porttitor ut, viverra nec felis. Aenean vitae nisl at est rutrum sollicitudin. Donec pellentesque sollicitudin leo nec commodo. Praesent vulputate nibh ut eros accumsan et commodo ipsum tincidunt. Ut at est nulla. Morbi interdum tempor fermentum. Nam a orci hendrerit est tincidunt vehicula nec vel mauris. Maecenas ante ligula, iaculis id auctor ultrices, molestie eget augue. Etiam ac arcu nunc, in mattis erat. Sed gravida enim eget lorem varius et ullamcorper quam rutrum.',
        'Nunc nec vestibulum diam. Morbi consequat, turpis vel eleifend iaculis, enim magna auctor dui, eu porta orci dolor nec libero. Integer hendrerit porta sollicitudin. Cras augue felis, commodo eget tempus non, sollicitudin at diam. Mauris molestie ante eget dui adipiscing nec sodales augue pharetra. Vivamus sodales tristique metus eu ultrices. Ut non tellus velit. Etiam eget diam nisi. Phasellus orci leo, ultricies non tempus ut, lobortis semper tortor. Nulla gravida, dolor vel euismod sagittis, magna odio eleifend eros, quis imperdiet eros nibh in lacus. Etiam tristique hendrerit tellus, id convallis felis varius vel. Curabitur iaculis eleifend sapien, ac consectetur velit sollicitudin accumsan. Aliquam erat volutpat. Sed sit amet libero sapien, at ultrices ligula. Donec est justo, ornare ut sollicitudin quis, placerat eget diam. Aliquam urna sem, mattis ut tincidunt non, varius non nibh.',
        'Maecenas augue tellus, laoreet ut convallis eu, tincidunt vitae nisl. Vivamus elementum, eros sed vestibulum pellentesque, metus urna condimentum velit, sed mollis dolor risus ut purus. Integer vel nulla quam. Mauris at blandit tortor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin non turpis enim. Sed tincidunt volutpat lectus et euismod. Quisque sit amet risus nisi. Curabitur rhoncus tempus luctus. Nam in tempus odio. Donec justo felis, aliquam sed fringilla lobortis, dapibus ac mi.',
        'Proin ac vehicula nibh. Donec condimentum condimentum tortor non ultrices. Nulla scelerisque elit sit amet diam mollis ullamcorper. Ut suscipit faucibus sagittis. Aliquam et turpis nec odio facilisis condimentum. Duis accumsan quam vitae erat auctor vitae consequat enim porta. Nulla fermentum, mi et interdum accumsan, dui nisl vulputate tortor, id iaculis sapien diam a diam. Mauris vitae mollis enim. Phasellus laoreet varius purus ac ullamcorper. Duis fringilla orci sed mi condimentum non mollis enim eleifend. Sed tincidunt, magna vel facilisis consequat, velit dolor tincidunt mauris, vitae semper sapien metus sit amet urna. Pellentesque tortor turpis, posuere in rutrum ut, sagittis ut velit.',
        'Proin interdum vestibulum mauris, nec venenatis arcu viverra sit amet. Fusce suscipit rhoncus nisi, et sagittis erat dignissim nec. Donec facilisis ultrices felis quis posuere. Nulla semper congue felis, quis mollis nunc iaculis eu. Mauris ac quam nec eros mattis luctus. Nulla condimentum egestas viverra. Etiam vestibulum viverra sagittis. Mauris vel nunc nunc. Cras vel erat sed lectus adipiscing molestie. Mauris nec odio neque, at commodo odio.',
        'Nunc posuere felis eu velit porttitor in dignissim enim pulvinar. Sed vitae consequat tellus. Nulla sagittis, massa nec eleifend feugiat, velit elit porttitor tortor, quis tincidunt turpis dui eu risus. Vivamus tortor neque, volutpat non pellentesque eu, pharetra sagittis mauris. Cras leo purus, malesuada nec rutrum ut, semper et lorem. Cras venenatis egestas sapien vitae condimentum. Sed lobortis nulla ac lorem placerat euismod vulputate felis placerat. Praesent sit amet nisi enim. Praesent id pulvinar purus. Vivamus facilisis imperdiet sapien id hendrerit. Nunc fringilla nisl et diam commodo quis viverra velit luctus.',
        'Ut dapibus nisl pretium lacus venenatis non suscipit elit ullamcorper. Fusce eros ligula, faucibus non tempor dapibus, ultrices vitae lectus. Donec vel ipsum ante. Maecenas ut turpis ut turpis ultrices lobortis non a dolor. Nunc ornare, ligula ac varius consequat, quam risus ultricies justo, sit amet ullamcorper risus dolor eu odio. Sed velit augue, imperdiet at malesuada vitae, laoreet sed nisi. Nam quis lectus vitae erat sagittis bibendum. Pellentesque pulvinar accumsan vulputate. Sed felis purus, laoreet quis hendrerit a, faucibus vel turpis.',
        'Etiam eleifend nisi vel justo accumsan commodo. Quisque accumsan, elit sagittis laoreet ultrices, quam nunc pulvinar neque, eu sodales mauris dui non nisi. Aenean at facilisis ligula. Aliquam rutrum neque metus. Nulla id nisl lectus, iaculis bibendum est. Aliquam erat volutpat. Mauris tempus dignissim libero vitae consequat. Maecenas quis felis dolor. Donec urna leo, auctor bibendum condimentum non, dignissim sit amet augue. Sed euismod, sapien sit amet auctor ultrices, lectus magna rutrum sem, et aliquet sapien felis ut risus. Morbi pretium magna at mauris adipiscing bibendum. Maecenas purus risus, tincidunt eu fringilla sit amet, iaculis id massa. Nullam at lorem sapien, nec suscipit mi. Suspendisse id lorem arcu, a mattis tellus.',
    );

    /**
     * @var int
     */
    private static $countRequest = 0;

    /**
     * @var int
     */
    private static $countLorem = 0;

    /**
     * @param int $min
     * @param int $max
     * @return string
     */
    public static function  getParagraph($min = 0, $max = 0)
    {
        if (!self::$countLorem) {
            self::$countLorem = count(self::$lorem);
        }
        $data = self::$lorem[mt_rand(0, self::$countLorem - 1)];
        if ($max && self::$countRequest < 3 && (strlen($data) < $min || strlen($data) > $max)) {
            ++self::$countRequest;
            $data = self::getParagraph($min, $max);
        }
        self::$countRequest = 0;

        return $data;
    }

    public static function getRandomParagraphs($min = 0, $max = 0)
    {
        $rand = mt_rand(1, 100);
        $return = array();
        for ($i = 0; $i < $rand; $i++) {
            $return[] = self::getParagraph($min, $max);
        }

        return $return;
    }
}