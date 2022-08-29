from nltk.tokenize import sent_tokenize, word_tokenize
from nltk.corpus import stopwords
import nltk
import string
from collections import Counter
import sys
output=""
for i in range(1,len(sys.argv)):
    output = output + sys.argv[i] + " "

userMessage = output

# def cleantext(userMessage):
#     text = userMessage
#     lower_case = text.lower()
#     cleaned_text = lower_case.translate(str.maketrans('', '', string.punctuation))

#     # Using word_tokenize because it's faster than split()
#     tokenized_words = word_tokenize(cleaned_text, "english")

#     # Removing Stop Words
#     final_words = []
#     for word in tokenized_words:
#         if word not in stopwords.words('english'):
#             final_words.append(word)

#     # Lemmatization - From plural to single + Base form of a word (example better-> good)
#     lemma_words = []
#     for word in final_words:
#         word = WordNetLemmatizer().lemmatize(word)
#         lemma_words.append(word)
#     print(lemma_words)
#     emotion_list = []
#     with open('emotions.txt', 'r') as file:
#         for line in file:
#             clear_line = line.replace("\n", '').replace(",", '').replace("'", '').strip()
#             word, emotion = clear_line.split(':')

#             if word in lemma_words:
#                 emotion_list.append(emotion)
#     print(emotion_list)            

def generateHashtag(sentence):

    hash_tags = set()
    words = word_tokenize(sentence)
    word_tokens = [word for word in words if word.isalnum()]
    stop_words = set(stopwords.words('english'))
    filtered_sentence = []

    for word in word_tokens:
        if word not in stop_words:
            filtered_sentence.append(word)

    tagged_words = nltk.pos_tag(filtered_sentence)
    grammer = "NNP NNS NN VBG VB VBD VBN VBP NNPS JJ"

    for word in tagged_words:
        if (word[1] in grammer):
            hash_tags.add('#' + word[0])

    return hash_tags

print(generateHashtag(userMessage))
